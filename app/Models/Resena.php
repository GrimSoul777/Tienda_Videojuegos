<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resena extends Model
{
    protected $table = 'resenas';

    protected $primaryKey = 'id_resena';

    protected $fillable = [
        'id_usuario',
        'id_videojuego',
        'calificacion',
        'comentario',
        'fecha',
    ];

    protected function casts(): array
    {
        return [
            'calificacion' => 'integer',
            'fecha' => 'datetime',
        ];
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'id_usuario',
            'id_usuario'
        );
    }

    public function videojuego(): BelongsTo
    {
        return $this->belongsTo(
            Videojuego::class,
            'id_videojuego',
            'id_videojuego'
        );
    }
}