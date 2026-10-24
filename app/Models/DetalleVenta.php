<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleVenta extends Model
{
    protected $table = 'detalle_ventas';

    protected $primaryKey = 'id_detalle';

    protected $fillable = [
        'id_venta',
        'id_videojuego',
        'cantidad',
        'precio_unitario',
    ];

    protected function casts(): array
    {
        return [
            'cantidad' => 'integer',
            'precio_unitario' => 'decimal:2',
        ];
    }

    public function venta(): BelongsTo
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
    }

    public function videojuego(): BelongsTo
    {
        return $this->belongsTo(Videojuego::class, 'id_videojuego', 'id_videojuego');
    }
}