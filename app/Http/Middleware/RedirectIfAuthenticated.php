<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard('coordenador')->check()) {
            return redirect()->route('coordenador.dashboard');
        } else if (Auth::guard('professor')->check()) {
            return redirect()->route('professor.dashboard');
        } else if (Auth::check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
