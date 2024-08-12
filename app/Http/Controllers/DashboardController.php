<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use App\Models\UtilityCompany;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function handlePostRequest(Request $request)
    {
        // Validate the request data
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Get the selected date range from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Store the dates in the session
        session(['start_date' => $startDate, 'end_date' => $endDate]);

        return response()->json(['message' => 'Data processed successfully']);
    }

    public function index(Request $request)
    {
        $users = User::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $utilitycompanies = UtilityCompany::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $companies = Company::where('deleted_at', null)->get();
        $sources = LeadSource::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $statuses = LeadStatus::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        return view('pages/dashboards.index', compact('users', 'companies', 'sources', 'utilitycompanies', 'statuses'));
    }
}
