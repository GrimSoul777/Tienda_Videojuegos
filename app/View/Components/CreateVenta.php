<?php

namespace App\View\Components;

use App\Models\Cliente;
use App\Models\MetodoPago;
use App\Models\Usuario;
use App\Models\Videojuego;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateVenta extends Component
{
    public $clientes;
    public $usuarios;
    public $metodosPago;
    public $videojuegos;

    public function __construct()
    {
        $this->clientes = Cliente::orderBy('nombre')->get();

        // Obtener únicamente administradores y empleados.
        $this->usuarios = Usuario::whereHas('rol', function ($query) {
            $query->whereIn('nombre', ['Administrador', 'Empleado']);
        })->orderBy('nombre')->get();

        $this->metodosPago = MetodoPago::orderBy('nombre')->get();
        $this->videojuegos = Videojuego::orderBy('titulo')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.create-venta');
    }
}
