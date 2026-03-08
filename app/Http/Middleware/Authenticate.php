<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        // Si aucun guard n'est passé, on met null
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {

            if (Auth::guard($guard)->check()) {
                return $next($request);
            }

            // Redirection selon le guard
            if ($guard === 'administrateur') {
                return redirect('/login');
            }

        }

        return redirect('/login');
    }
}