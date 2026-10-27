<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use App\Models\Videojuego;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ResenaController extends Controller
{
    public function getResenas()
    {
        $resenas = Resena::with(['cliente', 'videojuego'])->get();
        $clientes = Cliente::all();
        $videojuegos = Videojuego::all();

        return view('resenas', compact(
            'resenas',
            'clientes',
            'videojuegos'
        ));
    }

    public function createResena(Request $request)
    {
        // Obtener al usuario que inició sesión
        $usuario = \Illuminate\Support\Facades\Auth::user();

        // Buscar su registro en la tabla clientes usando el correo
        $cliente = Cliente::where('email', $usuario->email)->first();

        // Verificar que exista como cliente
        if (!$cliente) {
            return back()->with(
                'mensaje',
                'No se encontró tu registro de cliente.'
            );
        }

        // Validar los datos de la reseña
        $request->validate([
            'id_videojuego' => 'required|exists:videojuegos,id_videojuego',
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string'
        ]);

        // Evitar reseñas duplicadas del mismo videojuego
        $existe = Resena::where('id_cliente', $cliente->id_cliente)
            ->where('id_videojuego', $request->id_videojuego)
            ->exists();

        if ($existe) {
            return back()->withErrors([
                'id_videojuego' => 'Ya has publicado una reseña para este videojuego.'
            ])->withInput()->with('form', 'create');
        }

        // Registrar la reseña con el cliente identificado automáticamente
        Resena::create([
            'id_cliente' => $cliente->id_cliente,
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
