<?php

namespace App\Http\Controllers;

use App\DataTables\LeadStatusDataTable;
use App\Http\Controllers\Controller;
use App\Models\LeadStatus;
use Illuminate\Http\Request;

class LeadStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LeadStatusDataTable $dataTable)
    {
        return $dataTable->render('pages/leadstatus/list');
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
    public function show(LeadStatus $leadstatus)
    {
        return view('pages/leadstatus/show', compact('leadstatus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeadStatus $leadstatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeadStatus $leadstatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeadStatus $leadstatus)
    {
        //
    }
}
