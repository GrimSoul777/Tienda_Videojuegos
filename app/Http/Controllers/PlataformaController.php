<?php

namespace App\Http\Controllers;

use App\Models\Plataforma;
use Illuminate\Http\Request;

class PlataformaController extends Controller
{
    public function getPlataformas()
    {
        $plataformas = Plataforma::all();

        return view('plataforma', compact('plataformas'));
    }

    public function createPlataforma(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:plataformas,nombre',
            'fabricante' => 'nullable|string|max:255'
        ]);

        Plataforma::create([
            'nombre' => $request->nombre,
            'fabricante' => $request->fabricante
        ]);

        return redirect()->route('getplataformas')
            ->with('mensaje', 'Plataforma registrada');
    }

    public function updatePlataforma($id, Request $request)
    {
        $plataforma = Plataforma::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255|unique:plataformas,nombre,' . $id . ',id_plataforma',
            'fabricante' => 'nullable|string|max:255'
        ]);

        $plataforma->update([
            'nombre' => $request->nombre,
            'fabricante' => $request->fabricante
        ]);

        return redirect()->route('getplataformas')
            ->with('mensaje', 'Plataforma actualizada');
    }

    public function deletePlataforma($id)
    {
        $plataforma = Plataforma::findOrFail($id);
        $plataforma->delete();

        return redirect()->route('getplataformas')
            ->with('mensaje', 'Plataforma eliminada');
    }
}
