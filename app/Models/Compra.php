<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'producto_id',
        'proveedor',
        'cantidad',
        'costo_unitario',
        'costo_total',
    ];

    // 🔗 Relación: una compra pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}

