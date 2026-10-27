<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarRol
{
    public function handle(
        Request $request,
        Closure $next,
        ...$roles
    ): Response {
        // Comprobar si el usuario inició sesión
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Obtener el rol del usuario
        $rol = $request->user()->rol;

        // Comprobar si su rol está permitido
        if (!$rol || !in_array($rol->nombre, $roles)) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}