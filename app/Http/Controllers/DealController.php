<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\HomeType;
use App\Models\Lead;
use App\Models\LeadSource;
use App\Models\Role;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    // Display a listing of the deals
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $users = User::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $roles = Role::where('company_id', Auth::user()->company_id)->get();
        $leads = Lead::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $homeTypes = HomeType::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $leadSources = LeadSource::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $dealStages = Stage::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $communicationMethodQuery = Deal::join('users', 'deals.created_by', '=', 'users.id')
            ->whereNull('deals.deleted_at');
        $searchTerm = $request->input('search', '');
        if (!empty($searchTerm)) {
            $communicationMethodQuery->where(function ($q) use ($searchTerm) {
                if (is_numeric($searchTerm)) {
                    $q->where('deals.id', 'LIKE', "%{$searchTerm}%");
                } elseif (preg_match('/^[a-zA-Z\s]+$/', $searchTerm)) {
                    $q->where('deals.deal_name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('users.name', 'LIKE', "%{$searchTerm}%"); 
                }
            });
        }
        $communicationMethodQuery->select(
            'deals.*',
            'deals.id as deal_id'
        );
        $rows = $communicationMethodQuery->paginate(15)->withQueryString();
        return view('pages.deals.index', compact('rows', 'users', 'roles', 'leads', 'homeTypes', 'leadSources', 'dealStages'));
    }

    // Show the form for creating a new deal
    public function create()
    {
        return view('deals.create');
    }

    // Store a newly created deal in storage
    public function store(Request $request)
    {
        $request->validate([
            'deal_name' => 'required|string|max:255',
            // Add other validation rules as needed
        ]);

        Deal::create($request->all());

        return redirect()->route('deals.index')->with('success', 'Deal created successfully.');
    }

    // Display the specified deal
    public function show(Deal $deal)
    {
        return view('deals.show', compact('deal'));
    }

    // Show the form for editing the specified deal
    public function edit(Deal $deal)
    {
        return view('deals.edit', compact('deal'));
    }

    // Update the specified deal in storage
    public function update(Request $request, Deal $deal)
    {
        $request->validate([
            'deal_name' => 'required|string|max:255',
            // Add other validation rules
        ]);

        $deal->update($request->all());

        return redirect()->route('deals.index')->with('success', 'Deal updated successfully.');
    }

    // Remove the specified deal from storage
    public function destroy(Deal $deal)
    {
        $deal->delete();

        return redirect()->route('deals.index')->with('success', 'Deal deleted successfully.');
    }
}
