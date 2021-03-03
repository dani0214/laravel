<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informacion de su pedido</title>
</head>

<body>
    <div>
        <div>
            <h2>Factura detallada de su producto.</h2>
            <div>
                <h3>Ha adquirido los siguientes artículos:</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio producto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::getContent()->sortBy('name') as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}€</td>
                                <td>{{ $item->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- DIRECCION -->
            <div>
                <h3>Su pedido se enviará a la siguiente dirección:</h3>
                <h4>Nombre: {{ session('address.name') }}</h4>
                <h4>Dirección: {{ session('address.direccion') }}</h4>
            </div>
            <!-- PAGO -->
            <div>
                <h3>
                    Total:
                </h3>
                <h2>{{ Cart::getTotal() }}€</h2>
            </div>
        </div>
    </div>
</body>

</html>
