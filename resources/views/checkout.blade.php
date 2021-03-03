@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-10">
    <h2>Tu cesta de la compra</h2>
    @if (count(Cart::getContent()))
        <table class="table table-stripped">
            <thead>
                <th>IMAGEN</th>
                <th>NOMBRE</th>
                <th>Precio</th>
                <th>CANTIDAD</th>
                <th>ELIMINAR</th>
            </thead>
            <tbody>
                @foreach (Cart::getContent() as $producto)
                <tr>
                    <td><img src="{{'/imagenes/'.$producto->id}}.jpg" width="100" height="100"></td>
                    <td>{{$producto->name}}</td>
                    <td>{{$producto->price}}</td>   
                    <td class="align-middle">
                        <form action="{{ route('cart.update') }}" method="post">
                            @csrf
                            <div class="form-row align-items-middle justify-content-center">
                                <div class="col">
                                    <input type="hidden" name="id" value="{{ $producto->id }}">
                                    <input min="1" max="{{ $producto->attributes->stock }}" id="cantidad"
                                        name="cantidad"
                                        value="{{ $producto->quantity }}"
                                        type="number" class="form-control">
                                </div>
                                <div class="col-2">
                                    <button type="submit" name="btn" class="btn btn-info btn-sm">Actualizar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('cart.removeitem') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $producto->id }}">
                            <button type="submit" class="btn btn-link btn-sm text-danger">X</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>Subtotal de la compra ({{count(Cart::getContent())}} productos): {{Cart::getTotal()}}€</p>
        <form action="{{ route('pedido') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-primary btn-lg mt-1">Realizar compra</button>
        </form>
    @else
        <p>No hay productos en el carro de compra</p>
    @endif
</div>
</div>
@endsection