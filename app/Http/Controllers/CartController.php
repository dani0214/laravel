<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Cart;
use Auth;

class CartController extends Controller
{
    /**
    * Añadimos un producto al carrito
    */
    public function add(Request $request){
        if(Auth::user()){
            $producto=Producto::find($request->producto_id);
            Cart::add(
                array(
                    'id'=>$producto->id,
                    'name'=>$producto->producto,
                    'price'=>$request->precio_total,
                    'quantity'=>$request->cantidad
                )
            );
            return back()->with('success',"$producto->nombre ¡Se ha agregado con exito al carrito de compra!");
        } else return redirect()->to('/login');
    }

    /**
    * Mostramos los productos del carrito
    */
    public function cart(){
        return view("checkout");      
    }
    public function removeitem(Request $request)
    {
        Cart::remove([
            'id' => $request->id,
        ]);
        return back()->with('success', "Producto eliminado con éxito de su carrito.");
    }

    /**
    * Se vacia el carrito por completo
    */
    public function clear()
    {
        Cart::clear();
        return back()->with('success', "Se ha vaciado el carrito.");
    }
    /**
    * Actualizamos la cantidad de un producto del carrito
    */
    public function updateQuantity(Request $request)
    {
        Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->cantidad
            ),
        ));
        return back()->with('success', "Se ha modificado la cantidad.");
    }
}
