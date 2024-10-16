<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function billing(){
        $company = Company::where('id', Auth::user()->company_id)->first(); 
        $subscription = $company->subscription('default');
        if($company->stripe_id && $company->subscribed('default') && $subscription){
            return $company->redirectToBillingPortal(route('dashboard'));
        }else{
            return view('pages/billing/index', compact('company'));
        }
    }
    public function success()
    {
        return redirect()->route('dashboard')->with('success', 'Subscription activated successfully!');
    }

    public function cancel()
    {
        return redirect()->route('dashboard')->with('error', 'Subscription was canceled.');
    }
    
    public function cancelSubscription(Request $request)
    {
        $user = Company::where('id', Auth::user()->company_id)->first();
        $user->subscription($request->plan)->cancel();

        return redirect()->back()->with('success', 'Subscription canceled successfully.');
    }

    public function resumeSubscription(Request $request)
    {
        $user = Company::where('id', Auth::user()->company_id)->first();
        $user->subscription($request->plan)->resume();

        return redirect()->back()->with('success', 'Subscription resumed successfully.');
    }

}
