<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
public function handle($request, Closure $next)
{
    if (auth()->check() && auth()->user()->blocked) {
        auth()->logout();
        return redirect()->route('login')->withErrors(['email' => 'Tu cuenta está bloqueada.']);
    }
    return $next($request);
}
}
