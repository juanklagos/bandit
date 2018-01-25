@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Pasarela de pago</div>
                    <div class="panel-body">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form method="post" action="{{url('validate')}}" id="formBank">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Tipo de cuenta</label>
                                <select id="tipoPersona" name="tipoPersona" class="form-control">
                                    <option>PERSONA</option>
                                    <option>JURIDICO</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Banco para la trnasacción</label>
                                <select id="banks" name="banks" class="form-control">
                                </select>
                                <span id="message" style="color: red"></span>
                            </div>
                            <button type="button" onclick="validarBank()" class="btn btn-success btn-block">Seguir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
