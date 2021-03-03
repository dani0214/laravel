
@extends('layouts.app')
@section("content")
    <div class="container">
        <div class="col-md-10">

            <h1>Informacion detallada del producto</h1>
            @auth
                @if (Auth::user()->admin)
                    <div class="row">
                        <div class="col-md-1">
                            <a href="/admin/crear_destacados/{{$producto->id}}">Destacar</a>
                        </div>
                        <div class="col-md-2">
                            <a href="/admin/modificar_informacion/{{$producto->id}}">Modificar informacion</a>
                        </div>
                    </div>
                @endif
            @endauth
            <img src="{{'/imagenes/'.$producto->id}}.jpg" width="200" height="200">
            <ul>
                <p>
                    <h3>{{ $producto->producto }}</h3>
                    <p>
                        Descripcion: {{ $producto->descripcion }}
                        <p>
                            Precio: {{ round($producto->precio * $producto->iva,2) }} €
                        </p>
                    </p>
                    <form action="{{route('cart.add')}}" method="POST">
                        @csrf
                        <input type="number" min="1" max="{{$producto->stock}}" value="1" name="cantidad">
                        <input type="hidden" name="producto_id" value="{{$producto->id}}">
                        <input type="hidden" name="precio_total" value="{{ round($producto->precio * $producto->iva,2) }}">
                        @if(($producto->stock)<1)
                        <button type="submit" name="btn" class="btn" id="btn_disabled" disabled> <i
                            class="fa fa-ban"></i> Sin Stock</button>
                        @else
                        <button type="submit" name="btn" class="btn"> <i
                            class="fa fa-cart-plus"></i>AÑADIR AL CARRITO</button>
                        @endif
                    </form>
                </p>
            </ul>
        </div>
    </div>
@endsection
