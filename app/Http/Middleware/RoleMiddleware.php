<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
{
    if (! $request->user() || ! $request->user()->hasAnyRole($roles)) {
        throw UnauthorizedException::forRoles($roles);
    }

    return $next($request);
}
}