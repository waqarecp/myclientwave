<?php

namespace App\Http\Controllers;

use App\Models\HomeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeTypeController extends Controller
{
    // Display a listing of the home types
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $homeTypesQuery = HomeType::where('home_types.company_id', $companyId)
            ->join('users', 'home_types.created_by', '=', 'users.id')
            ->whereNull('home_types.deleted_at');
            // Apply search filters
        $searchTerm = $request->input('search', '');
        if (!empty($searchTerm)) {
            $homeTypesQuery->where(function ($q) use ($searchTerm) {
                // If the search term is numeric, search by ID and phone number
                if (is_numeric($searchTerm)) {
                    $q->where('home_types.id', 'LIKE', "%{$searchTerm}%");
                } elseif (preg_match('/^[a-zA-Z\s]+$/', $searchTerm)) {
                    $q->where('home_types.home_type_name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('users.name', 'LIKE', "%{$searchTerm}%"); 
                }
            });
        }

        // Select the necessary fields including state_name
        $homeTypesQuery->select(
            'home_types.*',
            'home_types.id as home_type_id'
        );
        // Paginate the results
        $rows = $homeTypesQuery->paginate(15)->withQueryString();

        return view('pages.home_types.index', compact('rows'));
    }

    // Show the form for creating a new home type
    public function create()
    {
        return view('home_types.create');
    }

    // Store a newly created home type in storage
    public function store(Request $request)
    {
        $request->validate([
            'home_type_name' => 'required|string|max:255',
        ]);

        $stage = HomeType::create([
            'company_id' => Auth::user()->company_id,
            'home_type_name' => $request->home_type_name,
            'created_by' => Auth::user()->id,
        ]);

        if ($stage) {
            return response()->json(['success' => 'Stage created successfully.']);
        } else {
            return response()->json(['error' => 'Failed to create new Stage'], 500);
        }
    }

    // Display the specified home type
    public function show(HomeType $homeType)
    {
        return view('home_types.show', compact('homeType'));
    }

    // Show the form for editing the specified home type
    public function edit(HomeType $homeType)
    {
        return view('home_types.edit', compact('homeType'));
    }

    // Update the specified home type in storage
    public function update(Request $request)
    {
        $request->validate([
            'update_home_type_name' => 'required|string|max:255',
        ]);
        if ($request->home_type_id) {
            $existingHomeType = HomeType::where('company_id', Auth::user()->company_id)
                ->where('home_type_name', $request->update_home_type_name)
                ->where('id', '!=', $request->home_type_id)
                ->first();

            if ($existingHomeType) {
                return response()->json(['error' => 'Home Type already exists.'], 400);
            }

            $homeType = HomeType::findOrFail($request->home_type_id);
            $homeType->home_type_name = $request->update_home_type_name;
            $homeType->updated_by = Auth::user()->id;

            if ($homeType->save()) {
                return response()->json(['success' => 'Home Type updated successfully']);
            } else {
                return response()->json(['error' => 'Failed to update Home Type'], 500);
            }
        }
    }

    // Remove the specified home type from storage
    public function destroy(Request $request)
    {
        $homeType = HomeType::findorFail($request->homeTypeId);
        $homeType->delete();

        return redirect()->route('home_types.index')->with('success', 'Home type deleted successfully.');
    }
}
