<?php

namespace App\Http\Controllers;

use App\DataTables\StateColourDataTable;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Setting;
use App\Models\StateColour;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StateColourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        // Fetch the states for these countries
        $states = State::whereIn('country_id', $assignedCountryIds)
            ->pluck('name', 'id')
            ->toArray();

        // Retrieve leads based on these states
        $stateColorQuery = StateColour::where('state_colours.company_id', $companyId) // Specify the table for company_id
            ->whereIn('state_colours.state_id', array_keys($states))
            ->join('states', 'state_colours.state_id', '=', 'states.id')  // Join with states table
            ->join('users', 'state_colours.created_by', '=', 'users.id')  // Join with users table
            ->whereNull('state_colours.deleted_at');

        // Apply search filters
        $searchTerm = $request->input('search', '');
        if (!empty($searchTerm)) {
            $stateColorQuery->where(function ($q) use ($searchTerm) {
                // If the search term is numeric, search by ID and phone number
                if (is_numeric($searchTerm)) {
                    $q->where('state_colours.id', 'LIKE', "%{$searchTerm}%");
                } elseif (preg_match('/^[a-zA-Z\s]+$/', $searchTerm)) {
                    $q->where('states.name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('users.name', 'LIKE', "%{$searchTerm}%"); 
                }
            });
        }

        // Select the necessary fields including state_name
        $stateColorQuery->select(
            'state_colours.*',
            'states.name as state_name'
        );

        // Paginate the results
        $rows = $stateColorQuery->paginate(15)->withQueryString();
        return view('pages.statecolour.list', compact('rows', 'countries', 'states'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'color_code' => 'required',
            'state_id' => 'required|int',
        ]);

        // Check if a StateColour already exists for the given state and company
        $existingStateColour = StateColour::where('company_id', Auth::user()->company_id)
            ->where('state_id', $request->state_id)
            ->first();

        if ($existingStateColour) {
            return response()->json(['error' => 'State Colour already exists for the selected state.'], 400);
        }

        $data = [
            'company_id' => Auth::user()->company_id,
            'state_id' => $request->state_id,
            'color_code' => $request->color_code,
            'created_by' => Auth::user()->id,
        ];

        $stateColour = StateColour::create($data);

        if ($stateColour) {
            return response()->json(['success' => 'New State Colour created']);
        } else {
            return response()->json(['error' => 'Failed to create new State Colour'], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(StateColour $statecolour)
    {
        return view('pages/statecolour/show', compact('statecolour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StateColour $statecolour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'update_color_code' => 'required',
            'update_state_id' => 'required|int',
        ]);

        if ($request->state_colour_id) {
            // Check if another StateColour exists for the same state and company (excluding the current one)
            $existingStateColour = StateColour::where('company_id', Auth::user()->company_id)
                ->where('state_id', $request->update_state_id)
                ->where('id', '!=', $request->state_colour_id)
                ->first();

            if ($existingStateColour) {
                return response()->json(['error' => 'State Colour already exists for the selected state.'], 400);
            }

            $stateColour = StateColour::findOrFail($request->state_colour_id);
            $stateColour->state_id = $request->update_state_id;
            $stateColour->color_code = $request->update_color_code;

            if ($stateColour->save()) {
                return response()->json(['success' => 'State Colour updated successfully']);
            } else {
                return response()->json(['error' => 'Failed to update State Colour'], 500);
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $stateColor = StateColour::findOrFail($request->stateColorId);
        $stateColor->deleted_at = now();
        if ($stateColor->save()) {
            return response()->json(['success' => true, 'message' => 'State Color successfully deleted']);
        }
        return response()->json(['failed' => true, 'message' => 'Failed to delete State Color!']);
    }

    public function getStates(Request $request)
    {
        $countryId = $request->countryId;

        if ($countryId) {
            $states = State::where('country_id', $countryId)->pluck('name', 'id')->toArray();
            return response()->json(['states' => $states]);
        }

        return response()->json(['states' => []]); // Return empty array if no countryId is provided
    }
}
