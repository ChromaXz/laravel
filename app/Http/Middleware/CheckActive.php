<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Alert;

class CheckActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && !Auth::user()->is_active){//is_active adalah kolom yang ada didatabase pada table users
            Auth::logout();
            return redirect('/')->with('error', 'Akun anda belum aktif');
        }
        return $next($request);
    }
}
