<?php

namespace App\Http\Controllers;

use App\DataTables\StateColourDataTable;
use App\Http\Controllers\Controller;
use App\Models\StateColour;
use App\Models\State;
use Illuminate\Http\Request;

class StateColourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StateColourDataTable $dataTable)
    {
        return $dataTable->render('pages/statecolour/list');
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
        //
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
    public function update(Request $request, StateColour $statecolour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StateColour $statecolour)
    {
        //
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
