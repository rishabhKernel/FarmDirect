<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth('api')->user();

        if (!in_array($user->role, $roles)) {
            return response()->json(['error' => 'Forbidden - insufficient permissions'], 403);
        }

        return $next($request);
    }
}
