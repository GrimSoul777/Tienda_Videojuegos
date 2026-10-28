<?php

namespace App\View\Components;

use App\Models\Videojuego;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateInventario extends Component
{
    public $videojuegos;

    public function __construct()
    {
        $this->videojuegos = Videojuego::doesntHave('inventario')
            ->orderBy('titulo')
            ->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.create-inventario');
    }
}
