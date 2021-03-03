@extends('layouts.app')
@section("content") 
<div class="container">
    <div class="col-md-10">
        <h2>Perfil del Usuario</h2>
        <div>
            <a href="/datos_usuario/modificar">Modificar mis datos</a>
            <a href="/datos_usuario/eliminar">Dar de baja mi cuenta</a>
        </div>
        <div>
            <p>
                Usuario: {{ Auth::user()->usuario }}
            </p>
            <p>
                Correo Electronico:{{ Auth::user()->email }}
            </p>
        </div>
    </div> 
</div>
@endsection