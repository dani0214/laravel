<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Http\Controllers\Pedidos;
use Cart;

class Pagos extends Controller
{
    /**
    * Realizamos la comprobacion del pago mediante paypal 
    */
    public function handlePayment() {
        $producto = [];
        $producto['items'] = [
            [
                'name' => 'Pedido',
                'price' => Cart::getTotal(),
                'desc'  => 'Compra cliente',
                'qty' => 1
            ]
        ];
        $producto['invoice_id'] = 1;
        $producto['invoice_description'] = "Compra cliente";
        $producto['return_url'] = route('success.payment');
        $producto['cancel_url'] = route('cancel.payment');
        $producto['total'] = Cart::getTotal();
        $provider = new ExpressCheckout;
        $res = $provider->setExpressCheckout($producto);
        $res = $provider->setExpressCheckout($producto, true);
        return redirect($res['paypal_link']);
    }
    /**
    * Mostramos la vista de cancelacion del pago en caso de que haya un error 
    */
    public function paymentCancel() {
        return view('cancelarpago');
    }
    /**
    * Mostramos la vista y realizamos el pedido una vez que todo ha salido bien
    */
    public function paymentSuccess(Request $request) {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $pedido = new Pedidos;
            $pedido->store();
            return view('exitoPago');
        }

        return view('cancelarpago');
    }
}
