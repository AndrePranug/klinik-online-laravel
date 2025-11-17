<?php

namespace App\Http\Middleware;

use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;

class PermissionMiddlewareGroup
{
    public function role()
    {
        return RoleMiddleware::class;
    }

    public function permission()
    {
        return PermissionMiddleware::class;
    }

    public function roleOrPermission()
    {
        return RoleOrPermissionMiddleware::class;
    }
}
