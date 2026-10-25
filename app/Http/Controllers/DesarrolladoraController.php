<?php

namespace App\Http\Controllers;

use App\Models\Desarrolladora;
use Illuminate\Http\Request;

class DesarrolladoraController extends Controller
{
    public function getDesarrolladoras()
    {
        $desarrolladoras = Desarrolladora::all();

        return view('desarrolladora', compact('desarrolladoras'));
    }

    public function createDesarrolladora(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'pais' => 'nullable|string|max:255',
        ]);

        Desarrolladora::create([
            'nombre' => $request->nombre,
            'pais' => $request->pais,
        ]);

        return redirect()->route('getdesarrolladoras')
            ->with('mensaje', 'Desarrolladora registrada');
    }

    public function updateDesarrolladora($id, Request $request)
    {
        $desarrolladora = Desarrolladora::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'pais' => 'nullable|string|max:255',
        ]);

        $desarrolladora->update([
            'nombre' => $request->nombre,
            'pais' => $request->pais,
        ]);

        return redirect()->route('getdesarrolladoras')
            ->with('mensaje', 'Desarrolladora actualizada');
    }

    public function deleteDesarrolladora($id)
    {
        $desarrolladora = Desarrolladora::findOrFail($id);
        $desarrolladora->delete();

        return redirect()->route('getdesarrolladoras')
            ->with('mensaje', 'Desarrolladora eliminada');
    }
}
