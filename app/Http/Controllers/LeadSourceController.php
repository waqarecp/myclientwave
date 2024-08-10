<?php

namespace App\Http\Controllers;

use App\DataTables\LeadSourceDataTable;
use App\Http\Controllers\Controller;
use App\Models\LeadSource;
use Illuminate\Http\Request;

class LeadSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LeadSourceDataTable $dataTable)
    {
        return $dataTable->render('pages/leadsource/list');
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
    public function show(LeadSource $leadSource)
    {
        return view('pages/leadsource/show', compact('leadSource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeadSource $leadsource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeadSource $leadsource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeadSource $leadsource)
    {
        //
    }
}
