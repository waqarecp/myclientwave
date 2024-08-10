<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckDynamicRoutePermissions
{
    public function handle($request, Closure $next, $resourceName)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $permissions = [
            "read {$resourceName}",
            "write {$resourceName}",
            "create {$resourceName}"
        ];
        foreach ($permissions as $permission) {
            if ($user->can($permission)) {
                return $next($request);
            }
        }
        return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
    }

}
