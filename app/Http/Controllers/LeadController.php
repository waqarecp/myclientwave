<?php

namespace App\Http\Controllers;

use App\DataTables\LeadDataTable;
use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Appointment;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(LeadDataTable $dataTable)
    {
        return $dataTable->render('pages/lead/list');
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
        // Validate the request data
        $request->validate([
            'owner_id' => 'required|integer',
            'sale_representative' => 'nullable|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'phone' => 'nullable|string|max:15',
            'email' => 'required|email|max:255',
            'utility_company_id' => 'nullable|integer',
            'call_center_representative' => 'nullable|integer',
            'lead_status' => 'required|integer',
            'lead_source_id' => 'nullable|integer',
            'appointment_sat' => 'nullable|boolean',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable|string',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'appointment_notes' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Create a new lead record
        $lead = Lead::create([
            'company_id' => Auth::user()->company_id,
            'owner_id' => $request->input('owner_id'),
            'sale_representative' => $request->input('sale_representative'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'mobile' => $request->input('mobile'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'utility_company_id' => $request->input('utility_company_id'),
            'call_center_representative' => $request->input('call_center_representative'),
            'lead_status' => $request->input('lead_status'),
            'lead_source_id' => $request->input('lead_source_id'),
            'appointment_sat' => $request->input('appointment_sat', 0),
            'street' => $request->input('street'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip' => $request->input('zip'),
            'country' => $request->input('country'),
            'created_by' => Auth::user()->id,
        ]);

        if ($lead) {
            // Create associated Appointment and Note records
            Appointment::create([
                'lead_id' => $lead->id,
                'company_id' => Auth::user()->company_id,
                'representative_user' => $request->input('call_center_representative'),
                'appointment_date' => $request->input('appointment_date'),
                'appointment_time' => $request->input('appointment_time'),
                'appointment_notes' => $request->input('appointment_notes'),
                'created_by' => Auth::user()->id,
            ]);

            Note::create([
                'lead_id' => $lead->id,
                'company_id' => Auth::user()->company_id,
                'user_id' => Auth::user()->id,
                'notes' => $request->input('notes'),
                'created_by' => Auth::user()->id,
            ]);
        }

        return redirect()->back()->with('success', 'Lead has been created successfully.');
    }

     /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        $statuses = [
            1 => 'Fresh',
            2 => 'Site Survey',
            3 => 'Engineering Design',
            4 => 'Proposal',
            5 => 'System Details Finalized',
            6 => 'PO Received',
            7 => 'Cold',
        ];
        return view('pages/lead/show', compact('lead', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        //
    }
}
