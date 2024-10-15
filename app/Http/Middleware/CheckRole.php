<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica si el usuario tiene el rol correspondiente
        if (Auth::check() && Auth::user()->role_id == $role) {
            return $next($request); // Deja pasar si el rol coincide
        }

        // Redirigir si no tiene el rol correcto
        return redirect('/cafeteria'); // O redirige a una página de "no autorizado"
    }
}
