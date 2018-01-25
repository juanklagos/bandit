<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transacciones extends Model
{
    protected $table = 'transacciones';
    protected $fillable =[
        'id',
        'user_id',
        'returnCode',
        'bankURL',
        'trazabilityCode',
        'transactionCycle',
        'transactionID',
        'sessionID',
        'bankCurrency',
        'bankFactor',
        'responseCode',
        'responseReasonCode',
        'responseReasonText',
        'reference',
        'requestDate',
        'bankProcessDate',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
