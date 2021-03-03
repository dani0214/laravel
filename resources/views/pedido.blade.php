@extends('layouts.app')

@section('content')
    @guest
        <div class="container text-center">
            <div class="jumbotron m-2">
                <h3>Inicie sesion para continuar:
                    <a href="{{ route('login') }}">Login</a>
                </h3>
                <h3>En caso de no tener cuenta:
                    <a href="{{ route('register') }}">Registrarse</a>
                </h3>
            </div>
        </div>
    @endguest
    @auth
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <h3 class="card-header">{{ __('Rellene los siguientes datos para realizar su pedido') }}</h3>

                        <div class="card-body">
                            <form method="POST" action="{{ route('direccion') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') ?? Auth::user()->name }}" required
                                            autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="direccion"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

                                    <div class="col-md-6">
                                        <input id="direccion" type="text"
                                            class="form-control @error('direccion') is-invalid @enderror" name="direccion"
                                            value="{{ old('direccion') ?? Auth::user()->direccion }}" required
                                            autocomplete="direccion">

                                        @error('direccion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tlf"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                                    <div class="col-md-6">
                                        <input id="tlf" type="text"
                                            class="form-control @error('tlf') is-invalid @enderror" name="tlf"
                                            value="{{ old('tlf') ?? Auth::user()->tlf }}" required
                                            autocomplete="tlf">

                                        @error('tlf')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Continuar al pago') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
