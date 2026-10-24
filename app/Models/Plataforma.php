<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plataforma extends Model
{
    protected $table = 'plataformas';

    protected $primaryKey = 'id_plataforma';

    protected $fillable = [
        'nombre',
        'fabricante',
    ];

    public function videojuegos(): BelongsToMany
    {
        return $this->belongsToMany(
            Videojuego::class,
            'videojuego_plataforma',
            'id_plataforma',
            'id_videojuego'
        );
    }
}