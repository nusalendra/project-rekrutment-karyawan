<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (auth()->check() && in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        switch (auth()->user()->role) {
            case 'Pelamar':
                return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
            case 'HRD':
                return redirect()->route('dashboardHRD')->with('error', 'You do not have permission to access this page.');
            case 'Manajer':
                return redirect()->route('dashboardManajer')->with('error', 'You do not have permission to access this page.');
            default:
                return redirect()->route('login')->with('error', 'You do not have permission to access this page.');
        }
    }
}
