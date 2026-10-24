<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MetodoPago extends Model
{
    protected $table = 'metodos_pago';

    protected $primaryKey = 'id_metodo_pago';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class, 'id_metodo_pago', 'id_metodo_pago');
    }
}