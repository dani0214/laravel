<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cart;
use App\Models\Producto;
use App\Models\Productos_Pedido;
use App\Models\Pedido;
use App\Mail\OrderReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use PDF;

class Pedidos extends Controller {
    /**
     * Comprueba es stock.
     * 
     * @return bool
     */
    public function checkStock(){
        $validCart = true;
        foreach (Cart::getContent() as $item) {
            if (!$this->checkStockValid($item)) {
                $validCart = false;
            } else {
                $producto = Producto::findOrFail($item->id);
                if (!$this->checkStockNotZero($item, $producto)) {
                    $validCart = false;
                } else {
                    if (!$this->checkEnoughStock($item, $producto)) {
                        $validCart = false;
                    }
                }
            }
        }
        return $validCart;
    }

    /**
     * Comprueba si el stock es un numero valido
     * 
     * @return bool
     */
    public function checkStockValid($item){
        if ($item->quantity <= 0) {
            Cart::remove($item->id);
            return false;
        }
        return true;
    }

    /**
     * Comprueba que el stock no es cero.
     * 
     * @return bool
     */
    public function checkStockNotZero($item, $producto){
        if ($producto->stock == 0) {
            Cart::remove($item->id);
            return false;
        }
        return true;
    }

    /**
     * Comprueba que hay suficiente stock para el pedido
     * 
     * @return bool
     */
    public function checkEnoughStock($item, $producto){
        if ($item->quantity > $producto->stock) {
            Cart::update($item->id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $producto->stock
                ),
            ));
            return false;
        }
        return true;
    }

    /**
     * Mostramos la informacion del pedido
     *
     * @return \Illuminate\Http\Response
     */
    public function fillAddress(){
        if (!$this->checkStock()) {
            return back()->with('stock_alert', "Ha ocurrido un problema con el numero de articulos. El carrito ha sido actualizado.");
        }
        return view('pedido');
    }

    /**
     * Mostramos los detalles del pago.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment() {
        return view('pago');
    }

    /**
     * Se valida la direccion dada por el usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validateAddress(Request $request) {
        $request->session()->put('address', $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tlf' => ['required', 'numeric', 'min:9'],
            'direccion' => ['required', 'string', 'max:255'],
        ]));
        return redirect()->to('pago');
    }

    /**
     * Guardamos el pedido
     * 
     */
    public function store() {
        $pedido = new Pedido;
        $pedido->fecha = NOW();
        $pedido->estado = 'Pendiente';
        $pedido->usuario_id = Auth::user()->id;
        $pedido->save();
        $productosCarrito = Cart::getContent();
        foreach ($productosCarrito as $producto) {
            $productos_pedido = new Productos_Pedido;
            $productos_pedido->pedido_id = $pedido->id;
            $productos_pedido->precio = $producto->price;
            $productos_pedido->producto_id = $producto->id;
            $productos_pedido->cantidad = $producto->quantity;
            $productos_pedido->save();
            $producto_stock = new mostrar_productos;
            $producto_stock->actualizar_stock($producto->id, $producto->quantity);
        }
         Mail::to(Auth::user()->email)->send(new OrderReceived());
        Cart::clear();
    }

    /**
     * Muestra todos los pedidos del usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function mostrarPedidos($user_id) {
        if (Auth::user()) {
            if (Auth::user()->id == $user_id) {
                $pedidos = Pedido::where('usuario_id', $user_id)->get();
                foreach ($pedidos as $pedido) {
                    $importe = Productos_Pedido::where('pedido_id', $pedido->id)->sum(DB::raw('precio * cantidad'));
                    $pedido->importe = $importe;
                }
                return view('mis_pedidos')->with('pedidos', $pedidos);
            } else {
                return view('error.denegado');
            }
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Mostramos los datos del pedido seleccionado.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function datosPedido($id) {
        if (Auth::user()) {
            $pedido = Pedido::findOrFail($id);
            if (Auth::user()->id == $pedido->usuario_id) {
                $importe = Productos_Pedido::where('pedido_id', $id)->sum(DB::raw('precio * cantidad'));
                $pedido->importe = $importe;
                $items = Productos_Pedido::where('pedido_id', $id)->get();
                foreach ($items as $item) {
                    $producto = Producto::where('id', $item->producto_id)->firstOrFail();
                    $item->producto = $producto;
                }
                return view('detalle_pedido')->with([
                    'pedido' => $pedido,
                    'items' => $items,
                ]);
            } else {
                return view('error.denegado');
            }
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Cancelar pedido
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelar($id) {
        if (Auth::user()) {
            $pedido = Pedido::findOrFail($id);
            if (Auth::user()->id == $pedido->usuario_id) {
                if ($pedido->estado == 'Pendiente') {
                    $pedido->estado = 'Cancelado';
                    $pedido->save();
                    $productos = Productos_Pedido::where('pedido_id', $id)->get();
                    foreach ($productos as $producto) {
                        $producto = Producto::where('id', $producto->producto_id)->firstOrFail();
                        $producto->stock = $producto->stock + $producto->cantidad;
                        $producto->save();
                    }
                    return redirect()->route('pedidos', ['user' => Auth::user()->id]);
                } else {
                    return view('error.enviado');
                }
            } else {
                return view('error.denegado');
            }
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Se confirma la cancelacion del pedido
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelarPedido($id) {
        if (Auth::user()) {
            $pedido = Pedido::findOrFail($id);
            if (Auth::user()->id == $pedido->usuario_id) {
                if ($pedido->estado == 'Pendiente') {
                    return view('cancelar_pedido')->with('id', $pedido->id);
                } else {
                    return view('error.shipped');
                }
            } else {
                return view('error.denegado');
            }
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Obtenemos el PDF de la factura
    */
    public function PDF($id) {
        $pedido = Pedido::findOrFail($id);
        $importe = Productos_Pedido::where('pedido_id', $id)->sum(DB::raw('precio * cantidad'));
        $pedido->importe = $importe;
        $items = Productos_Pedido::where('pedido_id', $id)->get();
        foreach ($items as $item) {
            $producto = Producto::where('id', $item->producto_id)->firstOrFail();
            $item->producto = $producto;
        }
        $pdf = PDF::loadView('factura', ['pedido' => $pedido, 'items' => $items]);
        return $pdf->download('factura'.$id.'.pdf');
    }

}