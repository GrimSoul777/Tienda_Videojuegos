<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use Illuminate\Http\Request;

class VideojuegoController extends Controller
{
    public function getVideojuegos()
    {
        $videojuegos = Videojuego::with([
            'categoria',
            'desarrolladora',
            'plataformas',
            'inventario'
        ])->get();

        return view('videojuego', compact('videojuegos'));
    }

    public function createVideojuego(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'fecha_lanzamiento' => 'nullable|date',
            'id_desarrolladora' => 'required|exists:desarrolladoras,id_desarrolladora',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'plataformas' => 'nullable|array',
            'plataformas.*' => 'integer|exists:plataformas,id_plataforma'
        ]);

        $videojuego = Videojuego::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'fecha_lanzamiento' => $request->fecha_lanzamiento,
            'id_desarrolladora' => $request->id_desarrolladora,
            'id_categoria' => $request->id_categoria
        ]);

        if ($request->filled('plataformas')) {
            $videojuego->plataformas()->sync($request->plataformas);
        }

        return redirect()->route('getvideojuegos')
            ->with('mensaje', 'Videojuego registrado');
    }

    public function updateVideojuego($id, Request $request)
    {
        $videojuego = Videojuego::findOrFail($id);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'fecha_lanzamiento' => 'nullable|date',
            'id_desarrolladora' => 'required|exists:desarrolladoras,id_desarrolladora',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'plataformas' => 'sometimes|array',
            'plataformas.*' => 'integer|exists:plataformas,id_plataforma'
        ]);

        $videojuego->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'fecha_lanzamiento' => $request->fecha_lanzamiento,
            'id_desarrolladora' => $request->id_desarrolladora,
            'id_categoria' => $request->id_categoria
        ]);

        if ($request->has('plataformas')) {
            $videojuego->plataformas()->sync(
                $request->input('plataformas', [])
            );
        }

        return redirect()->route('getvideojuegos')
            ->with('mensaje', 'Videojuego actualizado');
    }

    public function deleteVideojuego($id)
    {
        $videojuego = Videojuego::findOrFail($id);
        $videojuego->delete();

        return redirect()->route('getvideojuegos')
            ->with('mensaje', 'Videojuego eliminado');
    }
}
