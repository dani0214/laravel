@php
    use App\Models\Categoria;
    $categorias = Categoria::all();  
@endphp
<div class="menu">
    @auth

    @endauth
    <div class="col-md-2" id="lista_categorias">
        <span>
            <h3>Categorias</h3>
            <ul>
                @foreach($categorias as $categoria)
                <i class="fa fa-arrow-right">
                    <a href="/categoria={{ $categoria->id }}">
                        {{ $categoria->categoria }}
                    </a>
                </i>
                @endforeach
            </ul>
        </span>
    </div>
</div>