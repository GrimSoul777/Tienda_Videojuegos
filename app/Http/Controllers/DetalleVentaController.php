<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;

class DetalleVentaController extends Controller
{
    public function getDetallesVenta()
    {
        $detallesVenta = DetalleVenta::with([
            'venta',
            'videojuego'
        ])->get();

        return view('detalle_venta', compact('detallesVenta'));
    }
}
