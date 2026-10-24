<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Desarrolladora extends Model
{
    protected $table = 'desarrolladoras';

    protected $primaryKey = 'id_desarrolladora';

    protected $fillable = [
        'nombre',
        'pais'
    ];

    public function videojuegos(): HasMany
    {
        return $this->hasMany(Videojuego::class, 'id_desarrolladora', 'id_desarrolladora');
    }
}