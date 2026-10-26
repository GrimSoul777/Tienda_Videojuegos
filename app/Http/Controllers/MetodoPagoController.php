<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    public function getMetodosPago()
    {
        $metodosPago = MetodoPago::all();

        return view('metodo_pago', compact('metodosPago'));
    }

    public function createMetodoPago(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:metodos_pago,nombre',
            'descripcion' => 'nullable|string'
        ]);

        MetodoPago::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('getmetodospago')
            ->with('mensaje', 'Método de pago registrado');
    }

    public function updateMetodoPago($id, Request $request)
    {
        $metodoPago = MetodoPago::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255|unique:metodos_pago,nombre,' . $id . ',id_metodo_pago',
            'descripcion' => 'nullable|string'
        ]);

        $metodoPago->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('getmetodospago')
            ->with('mensaje', 'Método de pago actualizado');
    }

    public function deleteMetodoPago($id)
    {
        $metodoPago = MetodoPago::findOrFail($id);
        $metodoPago->delete();

        return redirect()->route('getmetodospago')
            ->with('mensaje', 'Método de pago eliminado');
    }
}
