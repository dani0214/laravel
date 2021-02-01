<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class mostrar_productos extends Controller
{
    public function index(){
        //$productos=\DB::table('Productos')->select("id","user")->get();
        $productos=Producto::all();
        return view("productos",compact("productos"));
    }
    public function informacion($id){
        //$productos=\DB::table('Productos')->select("id","user")->get();
        $producto=Producto::all()->where('id',$id)->first();
        return view("informacion_producto",compact("producto"));
    }
    public function categoria($id){
        $categorias=Categoria::all();
        //$productos=\DB::table('Productos')->select("id","user")->get();
        $productos=Producto::where('categoria_id',$id)->simplePaginate(3);
        return view("productos",compact("productos"), compact("categorias"));
    }

}
