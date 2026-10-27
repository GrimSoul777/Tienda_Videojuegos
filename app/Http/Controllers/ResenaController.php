<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use App\Models\Videojuego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResenaController extends Controller
{
    public function getResenas()
    {
        $resenas = Resena::with(['usuario', 'videojuego'])->get();
        $videojuegos = Videojuego::all();

        return view('resenas', compact(
            'resenas',
            'videojuegos'
        ));
    }

    public function createResena(Request $request)
    {
        $usuario = Auth::user();

        // Solo los usuarios con rol Cliente pueden crear reseñas.
        if ($usuario->rol?->nombre !== 'Cliente') {
            abort(403, 'No tienes permiso para crear reseñas.');
        }

        $request->validate([
            'id_videojuego' => 'required|exists:videojuegos,id_videojuego',
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string'
        ]);

        // Comprobar si el usuario ya reseñó este videojuego.
        $existe = Resena::where('id_usuario', $usuario->id_usuario)
            ->where('id_videojuego', $request->id_videojuego)
            ->exists();

        if ($existe) {
            return back()->withErrors([
                'id_videojuego' => 'Ya has publicado una reseña para este videojuego.'
            ])->withInput();
        }

        // Guardar la reseña con el usuario que inició sesión.
        Resena::create([
            'id_usuario' => $usuario->id_usuario,
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
        $usuario = Auth::user();

        // Verificar que sea un cliente y que la reseña sea suya.
        abort_unless(
            $usuario->rol?->nombre === 'Cliente'
            && $resena->id_usuario == $usuario->id_usuario,
            403,
            'No tienes permiso para editar esta reseña.'
        );

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
        $usuario = Auth::user();

        // Verificar que sea un cliente y que la reseña sea suya.
        abort_unless(
            $usuario->rol?->nombre === 'Cliente'
            && $resena->id_usuario == $usuario->id_usuario,
            403,
            'No tienes permiso para eliminar esta reseña.'
        );

        $resena->delete();

        return redirect()->route('getresenas')
            ->with('mensaje', 'Reseña eliminada');
    }
}
