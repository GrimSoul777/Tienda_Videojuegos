<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function getClientes()
    {
        $clientes = Cliente::all();

        return view('cliente', compact('clientes'));
    }

    public function createCliente(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clientes,email',
            'telefono' => 'nullable|digits_between:10,15|unique:clientes,telefono'
        ]);

        Cliente::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'telefono' => $request->telefono
        ]);

        return redirect()->route('getclientes')
            ->with('mensaje', 'Cliente registrado');
    }

    public function updateCliente($id, Request $request)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clientes,email,' . $id . ',id_cliente',
            'telefono' => 'nullable|digits_between:10,15|unique:clientes,telefono'
        ]);

        $cliente->update([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'telefono' => $request->telefono
        ]);

        return redirect()->route('getclientes')
            ->with('mensaje', 'Cliente actualizado');
    }

    public function deleteCliente($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('getclientes')
            ->with('mensaje', 'Cliente eliminado');
    }
}
