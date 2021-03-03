<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Destacado;
use App\Traits\UpdateStock;
use Illuminate\Http\Request;
use Auth;

class mostrar_productos extends Controller
{
    /**
    * Mostramos todos los productos almacenados en la base de datos
    */
    public function index(){
        //$productos=\DB::table('Productos')->select("id","user")->get();
        $productos=Producto::all();
        return view("productos",compact("productos"));
    }

    /**
    * Otenemos toda la informacion del producto dado por id
    */
    public function informacion($id){
        //$productos=\DB::table('Productos')->select("id","user")->get();
        $producto=Producto::all()->where('id',$id)->first();
        return view("informacion_producto",compact("producto"));
    }

    /**
    * Obtenemos todos los productos de la categoria requerida
    */
    public function categoria($id){
        $categorias=Categoria::all();
        //$productos=\DB::table('Productos')->select("id","user")->get();
        $productos=Producto::where('categoria_id',$id)->simplePaginate(3);
        return view("productos",compact("productos"));
    }

    /**
    * Se actualiza el stock
    */
    public function actualizar_stock($id, $cantidad){
        $producto = Producto::find($id);
        $producto->stock = $producto->stock - $cantidad;
        $producto->save();
    }

    /**
    * En caso de ser administrador mostramos la vista para destacar un producto
    */
    public function crearDestacado($id){
        if(Auth::user()->admin){
            $producto = Producto::find($id);
            return view('auth.crear_destacado',compact("producto"));
        }
        else
            return view('error.acceso_denegado');
    }

    /**
    * Validamos el formulario y lo almacenamos en la tabla destacados
    */
    public function destacar(Destacado $destacado ){
        if(Auth::user()->admin){
            $this->validate(request(), [
                'fecha_inicio' => ['required', 'date', 'before:fecha_fin'],
                'fecha_fin' => ['required', 'date', 'after:fecha_inicio'],
                'producto_id'=>['required', 'numeric'],
            ]);
            $destacado->producto_id=request('producto_id');
            $destacado->fecha_inicio=request('fecha_inicio');
            $destacado->fecha_fin=request('fecha_fin');
            $destacado->save();
            return redirect('/');
        }
        else
            return view('error.acceso_denegado');
    }

    /**
    * Mostramos la vista para actualizar la informacion de un producto en caso de ser administrador
    */
    public function modificarInformacion($id){
        if(Auth::user()->admin){
            $producto = Producto::find($id);
            return view('auth.modificar_informacion',compact("producto"));
        }
        else
            return view('error.acceso_denegado');
    }

    /**
    * Validamos y modificamos la informacion del producto
    */
    public function modificar(Producto $producto ){
        if(Auth::user()->admin){
            $this->validate(request(), [
                'producto'=>['required','string','max:20'],
                'precio'=>['required','numeric','between:1,99999999.99'],
                'iva'=>['required','numeric','between:1,1.99'],
                'descripcion'=>['required','string','max:500'],
                'stock'=>['required','numeric'],
            ]);
            $id=request('producto_id');
            $producto = Producto::find($id);
            $producto->producto=request('producto');
            $producto->precio=request('precio');
            $producto->iva=request('iva');
            $producto->descripcion=request('descripcion');
            $producto->stock=request('stock');
            $producto->save();
            return redirect('/');
        }
        else
            return view('error.acceso_denegado');
    }

}
