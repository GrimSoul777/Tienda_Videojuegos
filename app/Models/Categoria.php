<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function videojuegos(): HasMany
    {
        return $this->hasMany(Videojuego::class, 'id_categoria', 'id_categoria');
    }
}