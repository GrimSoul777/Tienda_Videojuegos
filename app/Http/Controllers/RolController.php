<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function getRoles()
    {
        $roles = Rol::all();

        return view('rol', compact('roles'));
    }

    public function createRol(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:roles,nombre',
            'descripcion' => 'nullable|string'
        ]);

        Rol::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('getroles')
            ->with('mensaje', 'Rol registrado');
    }

    public function updateRol($id, Request $request)
    {
        $rol = Rol::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255|unique:roles,nombre,' . $id . ',id_rol',
            'descripcion' => 'nullable|string'
        ]);

        $rol->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('getroles')
            ->with('mensaje', 'Rol actualizado');
    }

    public function deleteRol($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->delete();

        return redirect()->route('getroles')
            ->with('mensaje', 'Rol eliminado');
    }
}
