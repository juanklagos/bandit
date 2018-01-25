<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Transacciones;
use Illuminate\Http\Request;
use SoapClient;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Session;
class HomeController extends Controller
{
    private $url = null;
    private $tranKey = null;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->url = 'https://test.placetopay.com/soap/pse/?wsdl';
        $this->tranKey = '024h1IlD';
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (empty(Session::get('bancos'))){
          $client = new SoapClient($this->url, array("trace" => 1));
          $client->__setLocation('https://test.placetopay.com/soap/pse/');
          try {
              $banks = $client->getBankList(array('auth' => $this->Auth()));
          } catch (Exception $e) {
              $banks = array();
          }
          //guardo los bancos en session
        Session::put('bancos',$banks->getBankListResult->item);
      }
        $bancosIm = Session::get('bancos');
        return view('home',compact('bancosIm'));
    }

    //function para hashear la credencial
    private function Auth() {
        $seed = date('c');
        $hash = sha1($seed . $this->tranKey, false);
        $credenciales = array(
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => $hash,
            'seed' => $seed
        );
        return (object) $credenciales;
    }

    //consulto los bancos por ajax, por si se hace con ajax
    public function banks(){
        $client = new SoapClient($this->url, array("trace" => 1));
        $client->__setLocation('https://test.placetopay.com/soap/pse/');
        try {
            $banks = $client->getBankList(array('auth' => $this->Auth()));
        } catch (Exception $e) {
            $banks = array();
        }
        $array = json_encode((array)$banks);
        return $array;
    }
    public function validateForm(Request $request){
        $bank = $request->banks;
        $tipoPersona = $request->tipoPersona;
        //evitamos que se entre a este formulario sin los datos respectivos
        if (empty($bank)){
            return redirect('home')->with('message','Debe escoger un banco');
        }else{
        return view('validar',compact('bank','tipoPersona'));
        }
    }
    public function validateDate(PersonRequest $request){

        $person = array(
            'documentType' => $request->documentType,
            'document' => $request->document,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'company' => $request->company,
            'emailAddress' => $request->emailAddress,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'country' => 'CO',
            'phone' => $request->phone,
            'mobile' => $request->mobile
        );

        $transaction = array(
            'bankCode' => $request->bank,
            'bankInterface' => $request->tipoPersona == 'PERSONA' ? '0':'1',
            'returnURL' => \url('validarEnd'),
            'reference' => md5( Carbon::now()),
            'description' => 'PAGO BANDIT',
            'language' => 'ES',
            'currency' => 'COP',
            'totalAmount' => 5000,
            'taxAmount' => 0,
            'devolutionBase' => 0,
            'tipAmount' => 0,
            'payer' => $person,
            'buyer' => $person,
            'shipping' => $person,
            'ipAddress' => $_SERVER['REMOTE_ADDR'],
            'userAgent' => $_SERVER ['HTTP_USER_AGENT'],
        );

        $client = new SoapClient($this->url, array("trace" => 1));
        $client->__setLocation('https://test.placetopay.com/soap/pse/');
        try {
            $trans = $client->createTransaction(array(
                'auth' => $this->Auth(),
                'transaction'=>$transaction
            ));
        } catch (Exception $e) {
            $trans = array();
        }

        //almaceno datos en la sesion el id de la transaacion para preguntar luego
        \Session::put('idTransaccion',$trans->createTransactionResult->transactionID);

        $transaccion = new Transacciones();
        $transaccion->user_id = \Auth::user()->id;
        $transaccion->bankURL = $trans->createTransactionResult->bankURL;
        $transaccion->returnCode = $trans->createTransactionResult->returnCode;
        $transaccion->trazabilityCode = $trans->createTransactionResult->trazabilityCode;
        $transaccion->transactionCycle = $trans->createTransactionResult->transactionCycle;
        $transaccion->transactionID = $trans->createTransactionResult->transactionID;
        $transaccion->sessionID = $trans->createTransactionResult->sessionID;
        $transaccion->bankCurrency = $trans->createTransactionResult->bankCurrency;
        $transaccion->bankFactor = $trans->createTransactionResult->bankFactor;
        $transaccion->responseCode = $trans->createTransactionResult->responseCode;
        $transaccion->responseReasonCode = $trans->createTransactionResult->responseReasonCode;
        $transaccion->responseReasonText = $trans->createTransactionResult->responseReasonText;
        $transaccion->save();

      //  return var_dump($trans);

       if ($trans->createTransactionResult->returnCode == 'SUCCESS'){
            return redirect($trans->createTransactionResult->bankURL);
       }else{
            return redirect('validate')->with('message','Transsaccion no realizada correctamente');
       }


       // return view('validate');
    }

    public function validateEnd(Request $request){
        $transactionID = Session::get('idTransaccion');
    if (!empty($transactionID)) {
        $client = new SoapClient($this->url, array("trace" => 1));
        $client->__setLocation('https://test.placetopay.com/soap/pse/');
        try {
            $trans = $client->getTransactionInformation(array(
                'auth' => $this->Auth(),
                'transactionID' => $transactionID
            ));
        } catch (Exception $e) {
            $trans = array();
        }
        //  var_dump($trans);
        //consulto la transaccion en la bd
        $transaccionBd = Transacciones::where('transactionID', '=', $transactionID)->first();
        $transaccionBd->transactionState = $trans->getTransactionInformationResult->transactionState;
        $transaccionBd->requestDate = $trans->getTransactionInformationResult->requestDate;
        $transaccionBd->bankProcessDate = $trans->getTransactionInformationResult->bankProcessDate;
        $transaccionBd->onTest = $trans->getTransactionInformationResult->onTest;
        $transaccionBd->reference = $trans->getTransactionInformationResult->reference;
        $transaccionBd->responseReasonText = $trans->getTransactionInformationResult->responseReasonText;
        $transaccionBd->save();
    }
        $transacciones = Transacciones::all();
        return view('transacciones',compact('transacciones'));

    }
}
