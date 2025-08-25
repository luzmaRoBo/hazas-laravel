<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    public function handle(Request $request, Closure $next)
    {
        // Si no hay usuario logueado en sesión
        if (! $request->session()->has('usuario_id')) {
            return redirect()->route('login')
                             ->with('error', 'Debes iniciar sesión primero.');
        }
        return $next($request);
    }
}