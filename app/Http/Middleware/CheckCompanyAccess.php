<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCompanyAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        // Check if company id is 1 and role is 1 (admin)
        if ($user->company_id == 1 && ($user->roles[0] && $user->roles[0]->id == 1)) {
            return $next($request); // Allow access
        }

        return abort(403, 'Unauthorized action.'); // Deny access
    }
}
