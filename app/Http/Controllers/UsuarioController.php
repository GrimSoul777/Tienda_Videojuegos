<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function getUsuarios()
    {
        $usuarios = Usuario::with('rol')->get();
    $roles = \App\Models\Rol::all();

    return view('usuario', compact('usuarios', 'roles'));
    }

    public function createUsuario(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:8',
            'id_rol' => 'required|exists:roles,id_rol'
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_rol' => $request->id_rol
        ]);

        return redirect()->route('getusuarios')
            ->with('mensaje', 'Usuario registrado');
    }

    public function updateUsuario($id, Request $request)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $id . ',id_usuario',
            'password' => 'nullable|string|min:8',
            'id_rol' => 'required|exists:roles,id_rol'
        ]);

        $datos = [
            'nombre' => $request->nombre,
            'email' => $request->email,
            'id_rol' => $request->id_rol
        ];

        if ($request->filled('password')) {
            $datos['password'] = Hash::make($request->password);
        }

        $usuario->update($datos);

        return redirect()->route('getusuarios')
            ->with('mensaje', 'Usuario actualizado');
    }

    public function deleteUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('getusuarios')
            ->with('mensaje', 'Usuario eliminado');
    }
}
