<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Verificar si el usuario está autenticado. Si no, lo manda a iniciar sesión.
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // NOTA: Asumimos que la tabla de usuario tiene una columna 'role'.
        // Si no existe, este código generará otro error (propiedad no encontrada).
        if ($user->role !== $role) {
            // 2. Si el rol no coincide (ej. no es 'admin'), se redirige al dashboard.
            return redirect('/dashboard')->with('error', 'No tienes permisos para acceder a esta sección.');
        }

        // 3. Si tiene el rol, permite el acceso a la ruta.
        return $next($request);
    }
}
