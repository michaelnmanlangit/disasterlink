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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, \Closure $next, ...$roles)
{
    $user = $request->user();

    if (!$user || !$user->roles()->whereIn('name', $roles)->exists()) {
        abort(403, 'Unauthorized');
    }

    return $next($request);
}
}
