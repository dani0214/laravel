<span>
    <h4>Categorias</h4>
    <ul>
        @foreach($categorias as $categoria)
        <li>
            <a href="/categoria={{ $categoria->id }}">
                {{ $categoria->categoria }}
            </a>
        </li>
        @endforeach
    </ul>
</span>