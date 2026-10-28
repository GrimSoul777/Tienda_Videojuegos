<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Videojuego;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function getInventario()
    {
        $inventario = Inventario::with('videojuego')->get();

        $videojuegos = Videojuego::whereNotIn(
        'id_videojuego',
        Inventario::select('id_videojuego')
        )->get();

        return view('inventario', compact('inventario', 'videojuegos'));
    }

    public function createInventario(Request $request)
    {
        $request->validate([
            'id_videojuego' => 'required|exists:videojuegos,id_videojuego|unique:inventario,id_videojuego',
            'stock' => 'required|integer|min:0',
            'ubicacion' => 'nullable|string|max:255'
        ]);

        Inventario::create([
            'id_videojuego' => $request->id_videojuego,
            'stock' => $request->stock,
            'ubicacion' => $request->ubicacion
        ]);

        return redirect()->route('getinventario')
            ->with('mensaje', 'Inventario registrado');
    }

    public function updateInventario($id, Request $request)
    {
        $inventario = Inventario::findOrFail($id);

        $request->validate([
            'id_videojuego' => 'required|exists:videojuegos,id_videojuego|unique:inventario,id_videojuego,' . $id . ',id_inventario',
            'stock' => 'required|integer|min:0',
            'ubicacion' => 'nullable|string|max:255'
        ]);

        $inventario->update([
            'id_videojuego' => $request->id_videojuego,
            'stock' => $request->stock,
            'ubicacion' => $request->ubicacion
        ]);

        return redirect()->route('getinventario')
            ->with('mensaje', 'Inventario actualizado');
    }

    public function deleteInventario($id)
    {
        $inventario = Inventario::findOrFail($id);

        if ($inventario->stock > 0) {
            return redirect()->route('getinventario')
            ->with('error', 'No puedes eliminar un inventario con existencias.');
        }

        $inventario->delete();

        return redirect()->route('getinventario')
        ->with('mensaje', 'Registro de inventario eliminado');
    }
}