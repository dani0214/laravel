@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <div class="row">
                    <div class="container text-center">
                        <div>
                            <!-- Pedido INFO -->
                            <div class="row">
                                <div class="col">
                                    <h5>Número de pedido: {{ $pedido->id }}</h5>
                                </div>
                                <div class="col">
                                    <h5>Fecha: {{ date('d/m/Y', strtotime($pedido->fecha)) }}</h5>
                                </div>
                                <div class="col">
                                    <h5>Estado:{{($pedido->estado)}}</h5>
                                </div>
                            </div>
                            <!-- CLIENT INFO -->
                            <div class="row p-4">
                                <div class="col">
                                    <h4>Nombre: {{ Auth::user()->name }}</h4>
                                    <h4>Dirección: {{ Auth::user()->direccion }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <table class="table">
                    <thead class="text-center">
                        <th>IMAGEN</th>
                        <th>NOMBRE</th>
                        <th>PRECIO</th>
                        <th>CANTIDAD</th>
                    </thead>
                    <tbody class="">
                        @foreach ($items as $item)
                            <tr>
                                <td class="align-middle"><img src="{{'/imagenes/'.$item->producto_id}}.jpg" width="100" height="100"></td>
                                <td class="align-middle">{{ $item->producto->producto }}</td>
                                <td class="align-middle">{{ round($item->producto->precio *  $item->producto->iva,2)}}€</td>
                                <td class="align-middle">{{ $item->cantidad }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col text-right">
                        <h3 class="mt-1">Total: {{ $pedido->importe }} €</h3>
                    </div>
                </div>
                <!-- CANCEL -->
                @if ($pedido->estado == 'Pendiente')
                    <div class="row">
                        <div class="container mt-4 text-left">
                            <a href="{{ route('confirmar', $pedido->id) }}" class="btn">
                                Cancelar pedido
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
