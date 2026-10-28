<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Videojuego;
use App\Models\Inventario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VentaController extends Controller
{
    public function getVentas()
    {
        $ventas = Venta::with([
            'cliente',
            'usuario',
            'metodoPago',
            'detalles.videojuego'
        ])->get();

        // Obtener únicamente usuarios que no sean clientes.
        $usuarios = User::whereHas('rol', function ($query) {
            $query->where('nombre', '!=', 'Cliente');
        })->get();

        return view('venta', compact('ventas'));
    }

    public function createVenta(Request $request)
    {
        $request->validate([
            'id_cliente' => 'nullable|exists:clientes,id_cliente',
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'id_metodo_pago' => 'required|exists:metodos_pago,id_metodo_pago',
            'detalles' => 'required|array|min:1',
            'detalles.*.id_videojuego' => 'required|exists:videojuegos,id_videojuego',
            'detalles.*.cantidad' => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request) {
            $venta = Venta::create([
                'id_cliente' => $request->id_cliente,
                'id_usuario' => $request->id_usuario,
                'id_metodo_pago' => $request->id_metodo_pago,
                'fecha' => now(),
                'total' => 0
            ]);

            $total = 0;

            foreach ($request->detalles as $detalle) {
                $videojuego = Videojuego::findOrFail(
                    $detalle['id_videojuego']
                );

                $inventario = Inventario::where(
                    'id_videojuego',
                    $videojuego->id_videojuego
                )->lockForUpdate()->first();

                if (!$inventario ||
                    $inventario->stock < $detalle['cantidad']) {
                    throw ValidationException::withMessages([
                        'detalles' => 'No hay suficientes existencias de '
                            . $videojuego->titulo
                    ]);
                }

                $precio = $videojuego->precio;
                $subtotal = $precio * $detalle['cantidad'];

                $venta->detalles()->create([
                    'id_videojuego' => $videojuego->id_videojuego,
                    'cantidad' => $detalle['cantidad'],
                    'precio_unitario' => $precio
                ]);

                $inventario->decrement(
                    'stock',
                    $detalle['cantidad']
                );

                $total += $subtotal;
            }

            $venta->update(['total' => $total]);
        });

        return redirect()->route('getventas')
            ->with('mensaje', 'Venta registrada correctamente');
    }

    public function updateVenta($id, Request $request)
    {
        $venta = Venta::findOrFail($id);

        $request->validate([
            'id_cliente' => 'nullable|exists:clientes,id_cliente',
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'id_metodo_pago' => 'required|exists:metodos_pago,id_metodo_pago'
        ]);

        $venta->update([
            'id_cliente' => $request->id_cliente,
            'id_usuario' => $request->id_usuario,
            'id_metodo_pago' => $request->id_metodo_pago
        ]);

        return redirect()->route('getventas')
            ->with('mensaje', 'Venta actualizada');
    }

    public function deleteVenta($id)
    {
        DB::transaction(function () use ($id) {
            $venta = Venta::with('detalles')->findOrFail($id);

            // Devolver al inventario los productos de la venta
            foreach ($venta->detalles as $detalle) {
                $inventario = Inventario::where(
                    'id_videojuego',
                    $detalle->id_videojuego
                )->lockForUpdate()->first();

                if ($inventario) {
                    $inventario->increment(
                        'stock',
                        $detalle->cantidad
                    );
                }
            }

            // Los detalles se eliminan por la regla
            // cascadeOnDelete de la base de datos
            $venta->delete();
        });

        return redirect()->route('getventas')
            ->with('mensaje', 'Venta eliminada');
    }
}
