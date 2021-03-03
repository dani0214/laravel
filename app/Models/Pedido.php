<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'fecha',
        'estado',
        'usuario_id',
        'producto_pedido_id'
    ];
}
