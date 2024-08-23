<?php

namespace App\Http\Controllers;

use App\DataTables\LeadDataTable;
use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Timeline;
use App\Models\Appointment;
use App\Models\AppointmentNote;
use App\Models\Note;
use App\Models\User;
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
            'sale_representative' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'nullable',
            'phone' => 'required|string|max:25',
            'email' => 'required|email|max:255',
            'utility_company_id' => 'nullable|integer',
            'call_center_representative' => 'nullable|integer',
            'lead_source_id' => 'required|integer',
            'appointment_sat' => 'nullable|boolean',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:20',
            'country' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
        ]);
        $note_added = 0;
        $appointment_note_added = 0;
        $appointment_has_new_comment = 0;

        $note_added = $request->input('notes') ? 1 : 0;

        if ($request->input('appointment_notes')) {
            $appointment_note_added = 1;
            $appointment_has_new_comment = 1;
        }
        if (isset($request->user_ids)) {
            $userIds = implode(',', $request->user_ids);
        }
        if (isset($request->appointment_user_ids)) {
            $appointmentUserIds = implode(',', $request->appointment_user_ids);
        }
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
            'lead_source_id' => $request->input('lead_source_id'),
            'appointment_sat' => $request->input('appointment_sat', 0),
            'street' => $request->input('street'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip' => $request->input('zip'),
            'country' => $request->input('country'),
            'address_1' => $request->input('address1'),
            'address_2' => $request->input('address2'),
            'note_added' => $note_added,
            'created_by' => Auth::user()->id,
        ]);

        if ($lead) {
            // Create new Appointment if checked
            if ($lead->appointment_sat && $lead->appointment_sat == 1 && $request->input('appointment_date') != null && $request->input('appointment_time') != null) {
                $appointment = Appointment::create([
                    'lead_id' => $lead->id,
                    'status_id' => $request->input('status_id'),
                    'representative_user' => $request->input('call_center_representative'),
                    'appointment_date' => $request->input('appointment_date'),
                    'appointment_time' => $request->input('appointment_time'),
                    'appointment_street' => $request->input('street'),
                    'appointment_city' => $request->input('city'),
                    'appointment_state' => $request->input('state'),
                    'appointment_zip' => $request->input('zip'),
                    'appointment_country' => $request->input('country'),
                    'appointment_address_1' => $request->input('address1'),
                    'appointment_address_2' => $request->input('address2'),
                    'note_added' => $appointment_note_added,
                    'has_new_comments' => $appointment_has_new_comment,
                    'created_by' => Auth::user()->id,
                ]);
                // Insert appointment notes
                if ($appointment) {
                    // Create appointment status timeline
                    if ($appointment->id) {
                        $timeline = Timeline::create([
                            'appointment_id' => $appointment->id,
                            'status_id' => $request->input('status_id'),
                            'timeline_date' => date('Y-m-d'),
                            'note_added' => $note_added,
                            'created_by' => Auth::user()->id,
                        ]);

                        if ($request->input('appointment_notes') && $timeline->id) {
                            // Insert appointment notes if any
                            AppointmentNote::create([
                                'appointment_id' => $appointment->id,
                                'status_id' => $request->input('status_id'),
                                'user_id' => Auth::user()->id,
                                'user_ids' => $appointmentUserIds,
                                'unread_ids' => $appointmentUserIds,
                                'notes' => trim($request->input('appointment_notes')),
                                'created_by' => Auth::user()->id,
                            ]);
                        }
                        
                        // Insert lead notes
                        if ($request->input('notes')) {
                            Note::create([
                                'lead_id' => $lead->id,
                                'user_id' => Auth::user()->id,
                                'user_ids' => $userIds,
                                'unread_ids' => $userIds,
                                'notes' => trim($request->input('notes')),
                                'created_by' => Auth::user()->id,
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Lead has been created successfully.');
    }

     /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        $appointments = Appointment::whereNull('deleted_at')
            ->where('lead_id', $lead->id)
            ->with('status')
            ->get();
        return view('pages/lead/show', compact('lead', 'appointments'));
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

    public function noteStore(Request $request)
    {
        // Validate the request data
        $request->validate([
            'timeline_notes' => 'required|string',
        ]);
        if ($request->timeline_notes && $request->timeline_notes != Null) {
            if (isset($request->user_ids) && $request->user_ids != null) {
                $userIds = implode(',', $request->user_ids);
            }
            Note::create([
                'lead_id' => $request->lead_id,
                'user_id' => Auth::user()->id,
                'user_ids' => $userIds ?: null,
                'unread_ids' => $userIds ?: null,
                'notes' => $request->timeline_notes,
                'created_by' => Auth::user()->id,
            ]);
            return response()->json(['success' => true, 'message' => 'New Comment Added']);
        }
        return response()->json(['failed' => true, 'message' => 'Failed to Add Comment']);
    }

    public function markAsRead(Request $request)
    {
        $note = Note::where('id', $request->noteId)->first();

        $unread_ids = $note->unread_ids ? explode(',', $note->unread_ids) : [];

        if (($key = array_search(Auth::user()->id, $unread_ids)) !== false) {
            unset($unread_ids[$key]);
            $note->unread_ids = implode(',', $unread_ids);
            if (empty($unread_ids)) {
                $note->is_read = 1;
            }
            $note->save();
            return response()->json(['success' => true, 'message' => 'Note marked as read']);
        }
        return response()->json(['failed' => true, 'message' => 'Failed to Note marked as read']);
    }

    public function viewLeadComments(Request $request)
    {
        if ($request->lead_id) {
            $users = User::where('deleted_at', null)
                ->where('company_id', Auth::user()->company_id)
                ->get();
            $users = array_column($users->toArray(), 'name', 'id');
            $leadNotes = Note::where('lead_id', $request->lead_id)
                ->whereNull('deleted_at')
                ->get();
            return view('pages.lead.comments', compact('users', 'leadNotes'))->render();
        }
    }
}
