<?php

namespace App\Http\Middleware;

use App\Http\Helpers\Helper;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->hasRole('Admin')) {
            return Helper::sendError('Access denied.', [], 401);
        }

        return $next($request);
    }
}
