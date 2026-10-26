<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function getCategorias()
    {
        // Obtener todas las categorías
        // SELECT * FROM categorias;

        $categoria = Categoria::all();
        return view('categoria', compact('categoria'));
    }

    public function createCategoria(Request $request)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        // Registrar una nueva categoría
        $categoria = Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return redirect('/categoria')->with([
            'mensaje' => 'Categoría registrada'
        ]);
    }

    public function updateCategoria($id, Request $request)
    {
        // Buscar la categoría por su ID
        $categoria = Categoria::findOrFail($id);

        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        // Actualizar la categoría
        $categoria->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return redirect('/categoria')->with([
            'mensaje' => 'Categoría actualizada'
        ]);
    }

    public function deleteCategoria($id)
    {
        // Buscar la categoría
        $categoria = Categoria::findOrFail($id);

        // Eliminarla
        $categoria->delete();

        return redirect('/categoria')->with([
            'mensaje' => 'Categoría eliminada'
        ]);
    }
}
