<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;
use App\Models\User;

class CheckCompanyAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $roleCheck = $user->roles()->where('company_id', 1)->first(); // Adjust this query based on your roles model relationship
        
        // Check if the user is admin and belongs to company_id 1
        if ($user->id == 1 && $roleCheck && $roleCheck->id == 1) {
            return $next($request); // Allow access
        }

        return abort(403, 'Unauthorized action.'); // Deny access
    }
}
