@extends('layouts.app')

@section('content')

    <div class="container col-6 p-2">
        <div class="jumbotron text-center">
            <h2>Tenga en cuenta lo siguiente</h2>
            <h3>Está a punto de eliminar su cuenta.</h3>
            <h3>Es una accion irreversible</h3>
            <h3>¿Sigue queriendo seguir adelante?</h3>
            <div class="row text-center">
                <div class="col">
                    <a href="{{ route('users.delete', Auth::user()) }}" class="btn btn-primary">Si</a>
                </div>
                <div class="col">
                    <a href="/datos_usuario" class="btn btn-primary">No</a>
                </div>
            </div>
        </div>
    </div>

@endsection
