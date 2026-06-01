<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole {
    public function handle(Request $request, Closure $next, string $role): Response {
        // Validar si el usuario está logueado
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Validar si posee el rol correspondiente exigido por el endpoint
        if (Auth::user()->rol !== $role) {
            abort(403, 'Acceso denegado. No tienes los permisos necesarios para esta sección.');
        }

        return $next($request);
    }
}