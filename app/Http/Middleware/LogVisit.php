<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\Visit;

class LogVisit
{
    public function handle($request, Closure $next)
    {
        Visit::create([
            'ip' => $request->ip(),
            'user_id' => auth()->id(),
            'url' => $request->path(),
        ]);
        return $next($request);
    }
}