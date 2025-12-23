<?php

namespace App\Core\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roles)
    {
        // Divide la cadena de roles en una lista
        $rolesArray = explode('|', $roles);

        // Verifica si el rol del usuario está en la lista de roles permitidos
        if (!Auth::check() || !in_array(Auth::user()->rol->nombreRol, $rolesArray)) {
            return redirect()->route('bienvenida'); // Redirige si el rol no es correcto
        }   

        return $next($request);
    }
}
