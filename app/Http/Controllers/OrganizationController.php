<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    // Display a listing of records
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;     
        $query = Organization::where('organizations.company_id', $companyId)
            ->join('users', 'organizations.created_by', '=', 'users.id')
            ->whereNull('organizations.deleted_at')
            ->select(
                'organizations.*',
                'organizations.id as organization_id'
            );

        // Apply search filters
        $searchTerm = $request->input('search', '');
        if (!empty($searchTerm)) {
            $query->where('organizations.organization_name', 'LIKE', "{$searchTerm}%")
                ->orWhere('users.name', 'LIKE', "{$searchTerm}%");
        }

        // Paginate the results
        $rows = $query->paginate(15)->withQueryString();

        return view('pages.organizations.index', compact('rows'));
    }

    // Store/create new recoord
    public function store(Request $request)
    {
        $request->validate([
            'organization_name' => 'required|string|min:2|max:255',
        ]);

        $existingRecord = Organization::where('company_id', Auth::user()->company_id)
            ->where('organization_name', $request->organization_name)
            ->first();

        if ($existingRecord) {
            return response()->json(['error' => 'An organization of same name already exists.'], 400);
        }

        $insert = Organization::create([
            'company_id' => Auth::user()->company_id,
            'organization_name' => $request->organization_name,
            'created_by' => Auth::user()->id,
        ]);

        if ($insert) {
            return response()->json(['success' => 'New organization created successfully.']);
        } else {
            return response()->json(['error' => 'Failed to create new Organization'], 500);
        }
    }

    // Update a record
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        if ($request->id) {
            $existingRecord = Organization::where('company_id', Auth::user()->company_id)
                ->where('organization_name', $request->name)
                ->where('id', '!=', $request->id)
                ->first();

            if ($existingRecord) {
                return response()->json(['error' => 'An organization of same name already exists.'], 400);
            }

            $organization = Organization::findOrFail($request->id);
            $organization->organization_name = $request->name;
            $organization->updated_by = Auth::user()->id;

            if ($organization->save()) {
                return response()->json(['success' => 'This organization has been updated successfully']);
            } else {
                return response()->json(['error' => 'Failed to update this organization'], 500);
            }
        }
    }

    // Remove the specified record
    public function destroy(Request $request)
    {
        $organization = Organization::findorFail($request->id);
        $organization->delete();

        return redirect()->route('organizations.index')->with('success', 'Organization deleted successfully.');
    }
}