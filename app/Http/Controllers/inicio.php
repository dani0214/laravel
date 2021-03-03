<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Destacado;
use App\Models\Categoria;
use Illuminate\Http\Request;
    
class inicio extends Controller
{
    /**
    * Obtenemos todos los productos de la base de datos que estan en la tabla destacados 
    */
    public function index(){
        $productos=\DB::table("productos")
                    ->join("destacados", "productos.id","=","destacados.producto_id")
                    ->where([ ['fecha_inicio','<=',date('Y-m-d')],['fecha_fin','>=',date('Y-m-d')] ])
                    ->select("productos.*")
                    ->paginate(3);
        $destacados=true;
        return view("productos", compact("productos","destacados"));
    }
}
