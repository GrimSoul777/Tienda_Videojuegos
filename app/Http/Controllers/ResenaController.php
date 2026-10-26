<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use Illuminate\Http\Request;

class ResenaController extends Controller
{
    public function getResenas()
    {
        $resenas = Resena::with([
            'cliente',
            'videojuego'
        ])->get();

        return view('resena', compact('resenas'));
    }

    public function createResena(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_videojuego' => 'required|exists:videojuegos,id_videojuego',
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string'
        ]);

        $request->validate([
            'id_cliente' => 'unique:resenas,id_cliente,NULL,id_resena,id_videojuego,' .
                $request->id_videojuego
        ]);

        Resena::create([
            'id_cliente' => $request->id_cliente,
            'id_videojuego' => $request->id_videojuego,
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario,
            'fecha' => now()
        ]);

        return redirect()->route('getresenas')
            ->with('mensaje', 'Reseña registrada');
    }

    public function updateResena($id, Request $request)
    {
        $resena = Resena::findOrFail($id);

        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string'
        ]);

        $resena->update([
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario
        ]);

        return redirect()->route('getresenas')
            ->with('mensaje', 'Reseña actualizada');
    }

    public function deleteResena($id)
    {
        $resena = Resena::findOrFail($id);
        $resena->delete();

        return redirect()->route('getresenas')
            ->with('mensaje', 'Reseña eliminada');
    }
}
