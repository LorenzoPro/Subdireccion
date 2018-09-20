@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="logindiv col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">

            <div class="card">
                <div class="card-header row inicia-sesion">Inicia sesión</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="">Correo electrónico</label>

                            <div class="input-group input-group-lg">
                                <input placeholder="Correo electrónico" id="email" type="email" class="input-style form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                <span class="input-group-addon input-style" id="sizing-addon1">
                                  <i class="glyphicon glyphicon-user"></i>
                                </span>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="password" class="">Contraseña</label>

                            <div class="input-group input-group-lg">
                                <input placeholder="Contraseña" id="password" type="password" class="input-style form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <span class="input-group-addon input-style" id="sizing-addon1">
                                  <i class="glyphicon glyphicon-lock"></i>
                                </span>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <div class="">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="">
                                <button type="submit" id="boton" class="btn btn-default btn-lg col-md-12 col-xs-12 btn1">
                                    Aceptar
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
