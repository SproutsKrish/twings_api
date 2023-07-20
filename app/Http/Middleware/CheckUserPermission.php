<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserPermissions
{
    public function handle($request, Closure $next, ...$permissions)
    {
        $user = $request->user();

        // Check if the user has any of the required permissions
        foreach ($permissions as $permission) {
            if ($user->hasPermissionTo($permission)) {
                return $next($request);
            }
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
