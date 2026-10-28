<?php

namespace App\View\Components;

use App\Models\Cliente;
use App\Models\MetodoPago;
use App\Models\Usuario;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UpdateVenta extends Component
{
    public $clientes;
    public $usuarios;
    public $metodosPago;

    public function __construct(public $i)
    {
        $this->clientes = Cliente::orderBy('nombre')->get();

        $this->usuarios = Usuario::whereHas('rol', function ($query) {
            $query->whereIn('nombre', ['Administrador', 'Empleado']);
        })->orderBy('nombre')->get();

        $this->metodosPago = MetodoPago::orderBy('nombre')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.update-venta');
    }
}