@extends('layouts.app')
@section("content")
<div class="container">
    <div class="col-md-10">
        <h1>Productos</h1>
            <ul>
                @if(count($productos)>0)
                    <div class="row">
                        @foreach($productos as $producto)
                            <div class="col-md-3 text-center">
                                <p>
                                    <h3><a href="producto={{ $producto->id }}" class="alert-link">{{ $producto->producto }}</h3>
                                    <img src="{{'/imagenes/'.$producto->id}}.jpg" width="200" height="200">
                                    </a><br>
                                        <span>Precio: {{ round($producto->precio * $producto->iva,2) }} €</span>
                                    <form action="{{route('cart.add')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cantidad" value="1">
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
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No hay productos disponibles en este momento, vuelva mas tarde
                        <br>Sentimos las molestias
                    </p>
                @endif
            </ul>
        </div>
    </div>
    <div class="col-4 border p-5 mt-5 text-center"id="paginador">
        {{ $productos->links("vendor.pagination.simple-bootstrap-4") }}
    </div>
</div>

@endsection