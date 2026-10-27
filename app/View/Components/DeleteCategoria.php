<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteCategoria extends Component
{
    public $i;

    public function __construct($i)
    {
        $this->i = $i;
    }

    public function render(): View|Closure|string
    {
        return view('components.delete-categoria');
    }
}
