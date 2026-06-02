<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $fillable = [
        'pedido_id',
        'obra_id',
        'cantidad',
        'precio'
    ];

    public function obra()
    {
        return $this->belongsTo(Obra::class);
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}