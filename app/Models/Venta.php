<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'cliente',
        'total_venta',
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'venta_productos')
                    ->withPivot('cantidad', 'precio_unitario', 'subtotal')
                    ->withTimestamps();
    }
}
