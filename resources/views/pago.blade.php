@extends('layouts.app')

@section('content')
    @guest
        <div class="container text-center">
            <div class="jumbotron m-2">
                <h3>Inicie sesion para continuar:
                    <a href="{{ route('login') }}">Login</a>
                </h3>
                <h3>En caso de no tener cuenta:
                    <a href="{{ route('register') }}">Registrarse</a>
                </h3>
            </div>
        </div>
    @endguest
    @auth
        <div class="container text-center">
            <div class="col-md-10">
                <div class="container">
                    <h3>Factura:</h3>
                    <table class="table">
                        <thead class="text-center">
                            <th>NOMBRE</th>
                            <th>PRECIO</th>
                            <th>CANTIDAD</th>
                        </thead>
                        <tbody class="text-center">
                            @foreach (Cart::getContent()->sortBy('name') as $producto)
                                <tr>
                                    <td>{{ $producto->name }}</td>
                                    <td>{{ $producto->price }}€</td>
                                    <td>{{ $producto->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- DIRECCION -->
                <div class="container mt-5">
                    <h3>Su pedido se enviará a la siguiente dirección:</h3>
                    <h4>Nombre: {{ session('address.name') }}</h4>
                    <h4>Dirección: {{ session('address.direccion') }}</h4>
                    <h4>Telefono de Contacto: {{ session('address.tlf') }}</h4>
                </div>
                <!-- PAGO -->
                <div class="container mt-5">
                    <h3 class="display-5 text-center">
                        Total de la compra:
                    </h3>
                    <h2>{{ Cart::getTotal() }}€</h2>
                    <div class="text-center">
                        <a href="{{ route('make.payment') }}" class="btn btn-primary">
                            Hacer Pago
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
