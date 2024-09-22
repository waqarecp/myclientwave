<?php

namespace App\Http\Controllers;

use App\Models\CommunicationMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunicationMethodController extends Controller
{
    // Display a listing of communication methods
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $communicationMethodQuery = CommunicationMethod::where('communication_methods.company_id', $companyId)
            ->join('users', 'communication_methods.created_by', '=', 'users.id')
            ->whereNull('communication_methods.deleted_at');
            // Apply search filters
        $searchTerm = $request->input('search', '');
        if (!empty($searchTerm)) {
            $communicationMethodQuery->where(function ($q) use ($searchTerm) {
                // If the search term is numeric, search by ID and phone number
                if (is_numeric($searchTerm)) {
                    $q->where('communication_methods.id', 'LIKE', "%{$searchTerm}%");
                } elseif (preg_match('/^[a-zA-Z\s]+$/', $searchTerm)) {
                    $q->where('communication_methods.method_name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('users.name', 'LIKE', "%{$searchTerm}%"); 
                }
            });
        }

        // Select the necessary fields including state_name
        $communicationMethodQuery->select(
            'communication_methods.*',
            'communication_methods.id as communication_method_id'
        );
        // Paginate the results
        $rows = $communicationMethodQuery->paginate(15)->withQueryString();

        return view('pages.communication_methods.index', compact('rows'));
    }

    // Show the form for creating a new communication method
    public function create()
    {
        return view('communication_methods.create');
    }

    // Store a newly created communication method in storage
    public function store(Request $request)
    {
        $request->validate([
            'method_name' => 'required|string|max:255',
        ]);

        $communicationMethod = CommunicationMethod::create([
            'company_id' => Auth::user()->company_id,
            'method_name' => $request->method_name,
            'created_by' => Auth::user()->id,
        ]);

        if ($communicationMethod) {
            return response()->json(['success' => 'Communication Method created successfully.']);
        } else {
            return response()->json(['error' => 'Failed to create new Communication Method'], 500);
        }
    }

    // Display the specified communication method
    public function show(CommunicationMethod $communicationMethod)
    {
        return view('communication_methods.show', compact('communicationMethod'));
    }

    // Show the form for editing the specified communication method
    public function edit(CommunicationMethod $communicationMethod)
    {
        return view('communication_methods.edit', compact('communicationMethod'));
    }

    // Update the specified communication method in storage
    public function update(Request $request)
    {
        $request->validate([
            'update_method_name' => 'required|string|max:255',
        ]);
        if ($request->communication_method_id) {
            $existingCommunicationMethod = CommunicationMethod::where('company_id', Auth::user()->company_id)
                ->where('method_name', $request->update_method_name)
                ->where('id', '!=', $request->communication_method_id)
                ->first();

            if ($existingCommunicationMethod) {
                return response()->json(['error' => 'Communication Method already exists.'], 400);
            }

            $communicationMethod = CommunicationMethod::findOrFail($request->communication_method_id);
            $communicationMethod->method_name = $request->update_method_name;
            $communicationMethod->updated_by = Auth::user()->id;

            if ($communicationMethod->save()) {
                return response()->json(['success' => 'Communication Method updated successfully']);
            } else {
                return response()->json(['error' => 'Failed to update Communication Method'], 500);
            }
        }
    }

    // Remove the specified communication method from storage
    public function destroy(Request $request)
    {
        $communicationMethod = CommunicationMethod::findorFail($request->communicationMethodId);
        $communicationMethod->delete();

        return redirect()->route('communication_methods.index')->with('success', 'Communication Method deleted successfully.');
    }
}
