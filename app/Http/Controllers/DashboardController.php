<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\LeadSource;
use App\Models\Status;
use App\Models\Role;
use App\Models\Lead;
use App\Models\UtilityCompany;
use App\Models\Country;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

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
        $companyId = Auth::user()->company_id;

        // Get assigned countries for the company
        $assignedCountryIds = Setting::where('company_id', $companyId)
            ->pluck('country_id')
            ->toArray();

        // If no countries are assigned, use United States (id=233)
        if (empty($assignedCountryIds)) {
            $assignedCountryIds = [233];
        }

        // Fetch country names from the Country model
        $countries = Country::whereIn('id', $assignedCountryIds)->pluck('name', 'id');
        $users = User::where('deleted_at', null)
            ->where('company_id', $companyId)
            ->get();
        $roles = Role::where('company_id', Auth::user()->company_id)->get();
        $utilitycompanies = UtilityCompany::where('deleted_at', null)
            ->where('company_id', $companyId)
            ->get();
        $companies = Company::where('deleted_at', null)->get();
        $sources = LeadSource::where('deleted_at', null)
            ->where('company_id', $companyId)
            ->get();
        $statuses = Status::where('deleted_at', null)
            ->where('company_id', $companyId)
            ->get();
        $leads = Lead::where('deleted_at', null)
            ->where('company_id', $companyId)
            ->with('leadSource')
            ->get();
        $leadSources = $leads->groupBy('leadSource.id')
            ->map(function ($dataLead, $leadSourceId) {
                // Return the count of leads for each lead source
                return [
                    'count' => count($dataLead),
                    'source_name' => $dataLead->first()->leadSource->source_name ?? 'Unknown', // Get the source name or 'Unknown' if null
                ];
            })
            ->sortByDesc('count')  // Sort by lead count in descending order
            ->take(5);  // Take top 5 lead sources
        $leadData = $leads->groupBy(function($date){
            return \Carbon\Carbon::parse($date->created_at)->format('M d');
        })->map(function ($dateLeads) {
            return count($dateLeads);
        })->sortKeysDesc()
        ->take(5);
        $leadData = $leadData->toJson();
        $countLeads = count($leads);
        
        $appointments = Appointment::where('deleted_at', null)
            ->get();
        $appointmentData = $appointments->groupBy(function($date) {
            return \Carbon\Carbon::parse($date->appointment_date)->format('M d'); // Group by day
        })->map(function ($dayAppointments) {
            return count($dayAppointments);
        })->sortKeys();
        $appointmentData = $appointmentData->toJson();
        $countAppointments = count($appointments);

        return view('pages/dashboards.index', 
                    compact('users', 'companies', 'sources', 'utilitycompanies', 'statuses', 'leadSources', 
                        'roles', 'leadData', 'countLeads', 'appointmentData', 'countAppointments', 'countries'
                    )
                );
    }

}
