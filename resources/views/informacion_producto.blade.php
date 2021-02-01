@include('menu_app')
@section("content")
    <div class="container">
        <h1>Informacion detallada del producto</h1>
        <ul>
            <p>
                <h3>{{ $producto->producto }}</h3>
                <p>
                    Descripcion: {{ $producto->descripcion }}
                    <p>
                        Precio: {{ round($producto->precio * $producto->iva,2) }}
                    </p>
                </p>
            </p>
        </ul>
    </div>