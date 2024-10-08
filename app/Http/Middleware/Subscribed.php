<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Subscribed
{
    public function handle(Request $request, Closure $next): Response
    {
        $company = Company::where('id', Auth::user()->company_id)->first();
        
        if (!$company) {
            return redirect('/billing')->with('error', 'Your company does not exist.');
        }

        $subscription = $company->subscription('default');

        // Log information for debugging
        // Log::info('Company ID: ' . $company->id);
        // Log::info('Subscribed: ' . ($company->subscribed('default') ? 'Yes' : 'No'));
        // Log::info('On Trial: ' . ($company->onTrial('default') ? 'Yes' : 'No'));
        // Log::info('Ends At: ' . ($subscription && $subscription->ends_at ? $subscription->ends_at->toDateTimeString() : 'Not Set'));

        // Check if subscription is canceled or ended
        if ($subscription && $subscription->ends_at !== null) {
            return redirect('/billing')->with('error', 'Your subscription has been canceled.');
        }

        // If subscribed or on trial, proceed
        if ($company->subscribed('default') || $company->onTrial('default')) {
            return $next($request);
        }

        return redirect('/billing')->with('error', 'Your subscription is inactive.');
    }
}

