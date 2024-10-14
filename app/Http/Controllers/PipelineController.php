<?php

namespace App\Http\Controllers;

use App\Models\Pipeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class PipelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $query = Pipeline::where('pipeline.company_id', $companyId)
            ->join('users', 'pipeline.created_by', '=', 'users.id')
            ->whereNull('pipeline.deleted_at')
            ->select(
                'pipeline.*',
                'pipeline.id as pipeline_id'
            );

        // Apply search filters
        $searchTerm = $request->input('search', '');
        if (!empty($searchTerm)) {
            $query->where('pipeline.pipeline_name', 'LIKE', "{$searchTerm}%")
                ->orWhere('users.name', 'LIKE', "{$searchTerm}%");
        }

        // Paginate the results
        $rows = $query->paginate(15)->withQueryString();

        return view('pages.pipeline.index', compact('rows'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pipeline_name' => 'required|string|min:2|max:255',
            'stage_color_code' => 'nullable|string|max:7',
        ]);

        $existingRecord = Pipeline::where('company_id', Auth::user()->company_id)
            ->where('pipeline_name', $request->pipeline_name)
            ->first();

        if ($existingRecord) {
            return response()->json(['error' => 'An pipeline of same name already exists.'], 400);
        }

        $insert = Pipeline::create([
            'company_id' => Auth::user()->company_id,
            'pipeline_name' => $request->pipeline_name,
            'pipeline_color_code' => $request->pipeline_color_code,
            'created_by' => Auth::user()->id,
        ]);

        if ($insert) {
            return response()->json(['success' => 'New pipeline created successfully.']);
        } else {
            return response()->json(['error' => 'Failed to create new pipeline'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pages.pipeline.index', compact('pipeline'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.pipeline.edit', compact('pipeline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'pipeline_name' => 'required|string|max:255',
        ]);
        if ($request->id) {
            $existingRecord = Pipeline::where('company_id', Auth::user()->company_id)
                ->where('pipeline_name', $request->pipeline_name)
                ->where('id', '!=', $request->id)
                ->first();

            if ($existingRecord) {
                return response()->json(['error' => 'An pipeline of same name already exists.'], 400);
            }

            $pipeline = Pipeline::findOrFail($request->id);
            $pipeline->pipeline_name = $request->pipeline_name;
            $pipeline->pipeline_color_code = $request->pipeline_color_code;
            $pipeline->updated_by = Auth::user()->id;

            if ($pipeline->save()) {
                return response()->json(['success' => 'This pipeline has been updated successfully']);
            } else {
                return response()->json(['error' => 'Failed to update this pipeline'], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $pipeline = Pipeline::findorFail($request->id);
        $pipeline->delete();

        return redirect()->route('pipeline.index')->with('success', 'Pipeline deleted successfully.');
    }
}
