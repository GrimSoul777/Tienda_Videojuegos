<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventario extends Model
{
    protected $table = 'inventario';

    protected $primaryKey = 'id_inventario';

    protected $fillable = [
        'id_videojuego',
        'stock',
        'ubicacion',
    ];

    protected function casts(): array
    {
        return [
            'stock' => 'integer',
        ];
    }

    public function videojuego(): BelongsTo
    {
        return $this->belongsTo(Videojuego::class, 'id_videojuego', 'id_videojuego');
    }
}