<?php

namespace App\Http\Controllers;

use App\DataTables\AppointmentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Appointment;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(AppointmentDataTable $dataTable)
    {
        return $dataTable->render('pages/appointment/list');
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
    public function show(Appointment $appointment)
    {
        return view('pages/appointment/show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
