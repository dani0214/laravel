<?php
namespace App\Traits;
use App\Models\Producto;
use Illuminate\Http\Request;

trait UpdateStock{
    public function actualizar_stock($id, $cantidad){
        $producto = Producto::find($id);
        $producto->stock = $producto->stock - $cantidad;
        $producto->save();
    }
}