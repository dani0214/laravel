@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>¿Estas seguro que deseas cancelar este pedido?</h3>
                <a href="{{ route('cancelar', $id) }}" class="btn">
                    Cancelar pedido
                </a>
            </div>
        </div>
    </div>
@endsection