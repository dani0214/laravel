<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Destacado;
use App\Models\Categoria;
use Illuminate\Http\Request;

class inicio extends Controller
{
    public function index(){
        $productos=\DB::table("productos")
                    ->join("destacados", "productos.id","=","destacados.producto_id")
                    ->where([ ['fecha_inicio','<=',date('Y-m-d')],['fecha_fin','>=',date('Y-m-d')] ])
                    ->select("productos.*")
                    ->paginate(2);
        $categorias=Categoria::all();
        return view("inicio", compact("productos"), compact("categorias"));
    }
}
