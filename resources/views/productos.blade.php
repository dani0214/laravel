@include('menu_app')
@include('menu')
@section("content")
    <div class="container">
        <h1>Productos</h1>
        <ul>
            @if(count($productos)>0)
                @foreach($productos as $producto)
                <p>
                    <h3><a href="producto={{ $producto->id }}">{{ $producto->producto }}</a></h3>
                    <p>
                        Precio: {{ round($producto->precio * $producto->iva,2) }}
                    </p>
                </p>
                @endforeach
            @else
                <p>No hay productos disponibles en este momento, vuelva mas tarde
                    <br>Sentimos las molestias
                </p>
            @endif
        </ul>
       <div id="paginador">
        {{ $productos->links() }}
        </div>
    </div>