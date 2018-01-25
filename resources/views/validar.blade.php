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
                    <div class="panel-heading">Pasarela de pago <button class="btn right" onclick="datosDefecto()">Usar datos por defecto</button></div>
                    <div class="panel-body">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" ><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Estoy registrado</a></li>
                                <li role="presentation" class="active"><a href="#register" aria-controls="profile" role="tab" data-toggle="tab">Registrarme</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane" id="home">

                                    <div class="form-group{{ $errors->has('emailAddress2') ? ' has-error' : '' }}">
                                        <label>Correo electronico registrado:</label>
                                        <input name="emailAddress2" id="emailAddress2" type="email" class="form-control" required>
                                        @if ($errors->has('emailAddress2'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('emailAddress2') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <button class="btn-block btn btn-success">Seguir</button>

                                </div>
                                <div role="tabpanel" class="tab-pane active" id="register">
                                    <form action="{{url('enviardatos')}}" method="post">
                                        {{ csrf_field() }}
                                        <input hidden name="bank" value="{{$bank}}">
                                        <input hidden name="tipoPersona" value="{{$tipoPersona}}">
                                       {{-- <div class="form-group{{ $errors->has('bankInterface') ? ' has-error' : '' }}">
                                            <select class="form-control">
                                                <option>PERSONAS</option>
                                                <option>EMPRESAS</option>
                                            </select>
                                        </div>--}}
                                        <div class="form-group{{ $errors->has('document') ? ' has-error' : '' }}">
                                            <label>Tipo documento:</label>
                                            <select name="documentType" class="form-control">
                                                <option value="CC"  {{ old('documentType') == 'CC' ? 'selected' : '' }}>Cédula de ciudadanía colombiana</option>
                                                <option value="CE"  {{ old('documentType') == 'CE' ? 'selected' : '' }}>Cédula de extranjería</option>
                                                <option value="TI"  {{ old('documentType') == 'TI' ? 'selected' : '' }}>Tarjeta de identidad</option>
                                                <option value="PPN" {{ old('documentType') == 'PPN' ? 'selected' : '' }}>Pasaporte</option>
                                                <option value="NIT" {{ old('documentType') == 'NIT' ? 'selected' : '' }}>Número de identificación tributaria</option>
                                                <option value="SSN" {{ old('documentType') == 'SSN' ? 'selected' : '' }}>Social Security Number</option>
                                            </select>
                                            @if ($errors->has('documentType'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('documentType') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('document') ? ' has-error' : '' }}">
                                            <label>Documento:</label>
                                            <input name="document" id="document" type="text" value="{{old('document')}}" class="form-control" required>
                                            @if ($errors->has('document'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('document') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                                            <label>Nombres:</label>
                                            <input name="firstName" id="firstName" type="text" value="{{old('firstName')}}" class="form-control" required>
                                            @if ($errors->has('firstName'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                                            <label>Apellidos:</label>
                                            <input name="lastName" id="lastName" type="text" value="{{old('lastName')}}" class="form-control" required>
                                            @if ($errors->has('lastName'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                                            <label>Empresa:</label>
                                            <input name="company" id="company" type="text" value="{{old('company')}}" class="form-control" required>
                                            @if ($errors->has('company'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('emailAddress') ? ' has-error' : '' }}">
                                            <label>Correo electronico:</label>
                                            <input name="emailAddress" id="emailAddress" type="email" value="{{old('emailAddress')}}" class="form-control" required>
                                            @if ($errors->has('emailAddress'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('emailAddress') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                            <label>Dirección:</label>
                                            <input name="address" id="address" type="text" value="{{old('address')}}" class="form-control" required>
                                            @if ($errors->has('address'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }}">
                                            <label>Departamento:</label>
                                            <input name="province" id="province" type="text" value="{{old('province')}}" class="form-control" required>
                                            @if ($errors->has('province'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('province') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                            <label>Ciudad:</label>
                                            <input name="city" id="city" type="text" value="{{old('city')}}" class="form-control" required>
                                            @if ($errors->has('city'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label>Telefono:</label>
                                            <input name="phone" id="phone" type="text" value="{{old('phone')}}" class="form-control" required>
                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                            <label>Celular:</label>
                                            <input name="mobile" id="mobile" type="text" value="{{old('mobile')}}" class="form-control" required>
                                            @if ($errors->has('mobile'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block">Registrarme y seguir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection