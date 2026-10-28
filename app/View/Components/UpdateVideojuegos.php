<?php

namespace App\View\Components;

use App\Models\Categoria;
use App\Models\Desarrolladora;
use App\Models\Plataforma;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UpdateVideojuegos extends Component
{
    public $categorias;
    public $desarrolladoras;
    public $plataformas;

    public function __construct(public $i)
    {
        $this->categorias = Categoria::orderBy('nombre')->get();
        $this->desarrolladoras = Desarrolladora::orderBy('nombre')->get();
        $this->plataformas = Plataforma::orderBy('nombre')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.update-videojuegos');
    }
}
