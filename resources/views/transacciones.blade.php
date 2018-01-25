@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if (session('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de transacciones</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Usuario</th>
                                    <th>Fecha de realización</th>
                                    <th>Estado Local</th>
                                    <th>Estado Bancario</th>
                                    <th>Mensaje</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transacciones as $transaccion)
                                <tr>
                                    <th scope="row">{{$transaccion->id}}</th>
                                    <th>{{$transaccion->user->name}}</th>
                                    <td>{{$transaccion->created_at}}</td>
                                    <td>{{$transaccion->returnCode}}</td>
                                    <td>{{$transaccion->transactionState}}</td>
                                    <td>{{$transaccion->responseReasonText}}</td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop