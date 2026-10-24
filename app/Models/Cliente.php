<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'telefono',
    ];

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class, 'id_cliente', 'id_cliente');
    }

    public function resenas(): HasMany
    {
        return $this->hasMany(Resena::class, 'id_cliente', 'id_cliente');
    }
}