<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Videojuego extends Model
{
    protected $table = 'videojuegos';

    protected $primaryKey = 'id_videojuego';

    protected $fillable = [
        'titulo',
        'descripcion',
        'precio',
        'fecha_lanzamiento',
        'id_desarrolladora',
        'id_categoria',
    ];

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
            'fecha_lanzamiento' => 'date',
        ];
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function desarrolladora(): BelongsTo
    {
        return $this->belongsTo(Desarrolladora::class, 'id_desarrolladora', 'id_desarrolladora');
    }

    public function plataformas(): BelongsToMany
    {
        return $this->belongsToMany(
            Plataforma::class,
            'videojuego_plataforma',
            'id_videojuego',
            'id_plataforma'
        );
    }

    public function inventario(): HasOne
    {
        return $this->hasOne(Inventario::class, 'id_videojuego', 'id_videojuego');
    }

    public function detallesVenta(): HasMany
    {
        return $this->hasMany(DetalleVenta::class, 'id_videojuego', 'id_videojuego');
    }

    public function resenas(): HasMany
    {
        return $this->hasMany(Resena::class, 'id_videojuego', 'id_videojuego');
    }
}