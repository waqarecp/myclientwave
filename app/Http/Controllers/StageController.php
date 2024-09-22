<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StageController extends Controller
{
    // Display a listing of the stages
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $stageQuery = Stage::where('stages.company_id', $companyId)
            ->join('users', 'stages.created_by', '=', 'users.id')
            ->whereNull('stages.deleted_at');
            // Apply search filters
        $searchTerm = $request->input('search', '');
        if (!empty($searchTerm)) {
            $stageQuery->where(function ($q) use ($searchTerm) {
                // If the search term is numeric, search by ID and phone number
                if (is_numeric($searchTerm)) {
                    $q->where('stages.id', 'LIKE', "%{$searchTerm}%");
                } elseif (preg_match('/^[a-zA-Z\s]+$/', $searchTerm)) {
                    $q->where('stages.stage_name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('users.name', 'LIKE', "%{$searchTerm}%"); 
                }
            });
        }

        // Select the necessary fields including state_name
        $stageQuery->select(
            'stages.*',
            'stages.id as stage_id'
        );
        // Paginate the results
        $rows = $stageQuery->paginate(15)->withQueryString();

        return view('pages.stages.index', compact('rows'));
    }

    // Show the form for creating a new stage
    public function create()
    {
        return view('pages.stages.create');
    }

    // Store a newly created stage in storage
    public function store(Request $request)
    {
        $request->validate([
            'stage_name' => 'required|string|max:255',
            'stage_color_code' => 'nullable|string|max:7',
        ]);

        $stage = Stage::create([
            'company_id' => Auth::user()->company_id,
            'stage_name' => $request->stage_name,
            'stage_color_code' => $request->stage_color_code,
            'created_by' => Auth::user()->id,
        ]);

        if ($stage) {
            return response()->json(['success' => 'Stage created successfully.']);
        } else {
            return response()->json(['error' => 'Failed to create new Stage'], 500);
        }
    }

    // Display the specified stage
    public function show(Stage $stage)
    {
        return view('pages.stages.show', compact('stage'));
    }

    // Show the form for editing the specified stage
    public function edit(Stage $stage)
    {
        return view('pages.stages.edit', compact('stage'));
    }

    // Update the specified stage in storage
    public function update(Request $request)
    {
        $request->validate([
            'update_stage_name' => 'required|string|max:255',
            'update_stage_color_code' => 'nullable|string',
        ]);
        if ($request->stage_id) {
            $existingStage = Stage::where('company_id', Auth::user()->company_id)
                ->where('stage_name', $request->update_stage_name)
                ->where('id', '!=', $request->stage_id)
                ->first();

            if ($existingStage) {
                return response()->json(['error' => 'Stage already exists.'], 400);
            }

            $stage = Stage::findOrFail($request->stage_id);
            $stage->stage_name = $request->update_stage_name;
            $stage->stage_color_code = $request->update_stage_color_code;
            $stage->updated_by = Auth::user()->id;

            if ($stage->save()) {
                return response()->json(['success' => 'Stage updated successfully']);
            } else {
                return response()->json(['error' => 'Failed to update Stage'], 500);
            }
        }
    }

    // Remove the specified stage from storage
    public function destroy(Request $request)
    {
        $stage = Stage::findorFail($request->stageId);
        $stage->delete();

        return redirect()->route('stages.index')->with('success', 'Stage deleted successfully.');
    }
}
