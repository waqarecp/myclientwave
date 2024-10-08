<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $plan = "prod_QzHOhLntSqGFa8")
    {
        // Retrieve the company associated with the authenticated user
        $company = Company::where('id', Auth::user()->company_id)->first();
        if (!$company) {
            return back()->with('error', 'Company not found.');
        }

        // Check if the company already has an active or trialing subscription
        if ($company->subscribed('default')) {
            return back()->with('error', 'You already have an active subscription.');
        }

        // Determine if the trial should be applied
        $trial = $request->boolean('trial');

        // Handle subscription based on trial flag
        $subscriptionBuilder = $company->newSubscription('default', $plan);

        if ($trial) {
            // Apply a 15-day free trial if trial flag is set
            $subscriptionBuilder->trialDays(15);
        }

        // Proceed to Stripe checkout
        return $subscriptionBuilder->checkout([
            'success_url' => route('subscription.success'),
            'cancel_url' => route('subscription.cancel'),
        ]);
    }
}
