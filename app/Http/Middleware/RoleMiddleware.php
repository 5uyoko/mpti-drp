<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();

        // Jika role user sesuai dengan salah satu role yang diperbolehkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika role tidak cocok, tolak akses
        abort(403, 'Anda tidak memiliki akses.');
    }
}
