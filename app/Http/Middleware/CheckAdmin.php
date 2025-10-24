<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $requiredrole): Response
    {
        $user = auth()->user();

        if (!$user || !$user->roles || $user->usr_activation == 0) {
            return redirect('/forbidden');
        }

        if ($user->roles['rl_admin'] != $requiredrole) {
            if ($user->roles['rl_admin']) {
                return redirect('/dashboard');
            } else {
                return redirect('/home');
            }
        }

        return $next($request);
    }
}
