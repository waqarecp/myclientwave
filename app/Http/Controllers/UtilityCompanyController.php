<?php

namespace App\Http\Controllers;

use App\DataTables\UtilityCompanyDataTable;
use App\Http\Controllers\Controller;
use App\Models\UtilityCompany;
use Illuminate\Http\Request;

class UtilityCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UtilityCompanyDataTable $dataTable)
    {
        return $dataTable->render('pages/utilitycompany/list');
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
    public function show(UtilityCompany $utilityCompany)
    {
        return view('pages/utilitycompany/show', compact('utilityCompany'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UtilityCompany $utilitycompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UtilityCompany $utilitycompany)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UtilityCompany $utilitycompany)
    {
        //
    }
}
