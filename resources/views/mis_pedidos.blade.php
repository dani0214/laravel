@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 bg-light">
                <h3>Mis pedidos</h3>
                @if (count($pedidos))
                    <table class="table">
                        <thead class="text-center">
                            <th>ID del pedido</th>
                            <th>Fecha de la compra</th>
                            <th>Total Pedido</th>
                            <th>Estado Pedido</th>
                            <th>Informacion</th>
                            <th>Factura</th>
                        </thead>
                        <tbody class="">
                            @foreach ($pedidos as $pedido)
                                <tr>
                                    <td class="align-middle">{{ $pedido->id }}</td>
                                    <td class="align-middle">{{ date('d/m/Y', strtotime($pedido->fecha)) }}</td>
                                    <td class="align-middle">{{ $pedido->importe }}€</td>
                                    <td class="align-middle">{{ ($pedido->estado) }}</td>
                                    <td class="align-middle">
                                        <a href="{{ route('mi_pedido', $pedido->id) }}"><i class="fa fa-search"></i>Ver datos</a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('factura', $pedido->id) }}"><i class="fa fa-download">Descargar</i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="container text-center">
                        <div class="jumbotron m-2">
                            <h3 class="display-5 text-center">Aún no has realizado ningún pedido.</h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
