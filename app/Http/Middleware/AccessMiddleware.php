<?php

namespace App\Http\Middleware;

use App\Http\Helpers\Helper;
use Closure;
use Illuminate\Http\Request;

class AccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user->hasRole('Super Admin')) {
            return $next($request);
        } elseif ($user->hasRole('Admin')) {
            $allowedMethods = ['index', 'show', 'store'];

            if (in_array($request->route()->getActionMethod(), $allowedMethods)) {
                return $next($request);
            }
        }

        return Helper::sendError('Access denied.', [], 401);
    }
}
