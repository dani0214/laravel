<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class mostrar_categoria extends Controller
{
    /**
    * Mostramos las categorias almacenadas en la base de datos 
    */
    public function index(){
        //$categorias=\DB::table('categorias')->select("id","user")->get();
        $categorias=Categoria::all();
        return view("menu",compact("categorias"));
    }
}
