<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteInventario extends Component
{
    public function __construct(public $i)
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.delete-inventario');
    }
}
