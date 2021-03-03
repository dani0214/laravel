<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos_Pedido extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'pedido_id',
        'precio',
        'producto_id',
        'cantidad'
    ];
    protected $table='productos_pedidos';
}
