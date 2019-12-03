@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center  align-items-center min-vh-100">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-lock fa-3x"></i>
                        </div>
                        <div class="col-10">
                            <p class="h4"> SISTEMA BRICK</p>
                            <p>Bienvenido, introduce tus credenciales para iniciar!</p>
                        </div>
                    </div>
                </div>

                <div class="card-body bg-dark text-white">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo </label>

                            <div class="col-md-6">
                                <input id="login" type="login" class="form-control" name="login" value="{{ old('login') }}" required autofocus placeholder="Introduce tu E-Mail o Nombre de Usuario">

                                @error('login')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('login') }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    ENTRAR
                                </button>

                                <!--  @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection