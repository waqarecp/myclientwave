<?php

namespace App\Http\Controllers;

use App\DataTables\AppointmentDataTable;
use App\Jobs\SendFirebaseNotification;
use App\Http\Controllers\Controller;
use App\Mail\UserTagged;
use App\Models\Appointment;
use App\Models\AppointmentNote;
use App\Models\Timeline;
use App\Models\TimelineDocs;
use App\Models\User;
use App\Models\Lead;
use App\Models\Role;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\FirebaseToken;
use App\Models\Setting;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $users = User::where('deleted_at', null)->where('company_id', $companyId)->get();
        $leads = Lead::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $roles = Role::where('company_id', Auth::user()->company_id)->get();

        // Get assigned countries for the company
        $assignedCountryIds = Setting::where('company_id', $companyId)
            ->pluck('country_id')
            ->toArray();

        // If no countries are assigned, use United States (id=233)
        if (empty($assignedCountryIds)) {
            $assignedCountryIds = [233];
        }

        // Fetch country names from the Country model
        $countries = Country::whereIn('id', $assignedCountryIds)->pluck('name', 'id');

        $searchTerm = $request->input('search', '');
        $query = Appointment::join('leads', 'appointments.lead_id', '=', 'leads.id')
            ->join('status', 'appointments.status_id', '=', 'status.id')
            ->select(
                'appointments.*',
                'leads.first_name',
                'leads.last_name',
                DB::raw("CONCAT(leads.first_name, ' ', leads.last_name) as full_name"),
                'leads.phone',
                'leads.email',
                'leads.mobile',
                'status.status_name',
                'status.color_code',
                'leads.company_id',
                'leads.deleted_at as lead_deleted_at'
            )
            ->latest();

        // Apply search filter only if searchTerm is provided
        if (!empty($searchTerm)) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('appointments.id', 'LIKE', "%{$searchTerm}%")
                ->orWhere('leads.first_name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('leads.last_name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('leads.phone', 'LIKE', "%{$searchTerm}%")
                ->orWhere('leads.email', 'LIKE', "%{$searchTerm}%")
                ->orWhere('status.status_name', 'LIKE', "%{$searchTerm}%");
            });
        }

        $query->where("leads.company_id", "=", $companyId);

        // Paginate the results
        $rows = $query->paginate(15)->withQueryString();

        // Return the view with paginated data
        return view('pages.appointment.list', compact('users', 'leads', 'roles', 'countries', 'rows'));
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
        $request->validate([
            'lead_id' => 'integer|required',
            'representative_user' => 'integer|required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string',
            'appointment_street' => 'nullable|string|max:255',
            'appointment_country_id' => 'required|int',
            'appointment_state_id' => 'required|int',
            'appointment_city_id' => 'int',
            'appointment_zip' => 'nullable|string|max:20',
            'appointment_address_1' => 'required|string',
            'appointment_address_2' => 'nullable|string',
        ]);
        $data = [
            'lead_id' => $request->lead_id,
            'company_id' => Auth::user()->company_id,
            'representative_user' => $request->representative_user,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'appointment_street' => $request->appointment_street,
            'appointment_country_id' => $request->appointment_country_id,
            'appointment_state_id' => $request->appointment_state_id,
            'appointment_city_id' => $request->appointment_city_id,
            'appointment_zip' => $request->appointment_zip,
            'appointment_address_1' => $request->appointment_address_1,
            'appointment_address_2' => $request->appointment_address_2,
            'status_id' => '1',
            'timeline_date' => date('Y-m-d'),
            'created_by' => Auth::user()->id,
        ];
        $appointment = Appointment::create($data);
        if ($appointment) {
            Timeline::create([
                'appointment_id' => $appointment->id,
                'status_id' => $appointment->status_id,
                'timeline_date' => $appointment->timeline_date,
                'note_added' => '0',
                'created_by' => Auth::user()->id,
            ]);
            return response()->json(['success' => 'New Appointment created']);
        } else {
            return response()->json(['error' => 'Failed to create new Appointment'], 500);
        }
    }

    public function updateAppointment(Request $request)
    {
        $request->validate([
            'update_lead_id' => 'integer|required',
            'update_representative_user' => 'integer|required',
            'update_appointment_date' => 'required|date',
            'update_appointment_time' => 'required|string',
            'update_appointment_street' => 'nullable|string|max:255',
            'update_appointment_country_id' => 'required|int',
            'update_appointment_state_id' => 'required|int',
            'update_appointment_city_id' => 'int',
            'update_appointment_zip' => 'nullable|string|max:20',
            'update_appointment_address_1' => 'required|string',
            'update_appointment_address_2' => 'nullable|string',
        ]);
        if ($request->appointment_id) {
            $appointment = Appointment::findOrFail($request->appointment_id);
            $appointment->representative_user = $request->update_representative_user;
            $appointment->appointment_date = $request->update_appointment_date;
            $appointment->appointment_time = $request->update_appointment_time;
            $appointment->appointment_country_id = $request->update_appointment_country_id;
            $appointment->appointment_state_id = $request->update_appointment_state_id;
            $appointment->appointment_city_id = $request->update_appointment_city_id;
            $appointment->appointment_street = $request->update_appointment_street;
            $appointment->appointment_zip = $request->update_appointment_zip;
            $appointment->appointment_address_1 = $request->update_appointment_address_1;
            $appointment->appointment_address_2 = $request->update_appointment_address_2;
            if ($appointment->save()) {
                return response()->json(['success' => 'Appointment updated successfully']);
            }else {
                return response()->json(['error' => 'Failed to update Appointment'], 500);
            }
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $statusIds = Status::whereNull('deleted_at')
            ->where('company_id', Auth::user()->company_id)
            ->pluck('id')
            ->toArray();
        $timelines = Timeline::whereNull('deleted_at')
            ->where('appointment_id', $appointment->id)
            ->whereIn('status_id', $statusIds)
            ->with('status')
            ->with('timelineDocs')
            ->get();
        return view('pages/appointment/show', compact('appointment', 'timelines'));
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
    public function update(Request $request)
    {
        if ($request->appointment_id) {
            $appointment = Appointment::findOrFail($request->appointment_id);
            $appointment->status_id = $request->status_id;
            $appointment->timeline_date = $request->timeline_date;
            $uploadedFiles = [];
            if ($request->hasFile('new_file_uploaded')) {
                foreach ($request->file('new_file_uploaded') as $key => $file) {
                    $image_name = $key . round(time()) . "." . $file->getClientOriginalExtension();
                    $file->move(public_path('appointmentFileUploded'), $image_name);
                    $uploadedFiles[] = $image_name;
                }
                if (!empty($uploadedFiles)) {
                    $existingFiles = $appointment->file_uploaded ? explode(',', $appointment->file_uploaded) : [];
                    $allFiles = array_merge($existingFiles, $uploadedFiles);
                    $appointment->file_uploaded = implode(',', $allFiles);
                }
            }
            if ($appointment->save()) {
                // If the status has changed, create a new timeline entry
                $timelineId = $request->timeline_id;
                if ($request->current_status_id != $request->status_id) {
                    $createdTimeline = Timeline::create([
                        'appointment_id' => $request->appointment_id,
                        'status_id' => $request->status_id,
                        'timeline_date' => $request->timeline_date,
                        'created_by' => Auth::user()->id,
                    ]);
                    $timelineId = $createdTimeline->id;
                } else {
                    if ($timelineId) {
                        $timeline = Timeline::findOrFail($timelineId);
                        $timeline->timeline_date = $request->timeline_date;
                        $timeline->save();
                    }else {
                        $createdTimeline = Timeline::create([
                            'appointment_id' => $request->appointment_id,
                            'status_id' => $request->status_id,
                            'timeline_date' => $request->timeline_date,
                            'created_by' => Auth::user()->id,
                        ]);
                        $timelineId = $createdTimeline->id;
                    }
                }
                if (!empty($uploadedFiles)) {
                    foreach ($uploadedFiles as $image_name) {
                        TimelineDocs::create([
                            'timeline_id' => $timelineId,
                            'file_uploaded' => $image_name,
                            'created_by' => Auth::user()->id,
                        ]);
                    }
                }
            }
            return redirect()->back()->with('success', 'Appointment status timeline has been updated successfully.');
        }
        return redirect()->back()->with('error', 'Failed to Update appointment status timeline!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    public function viewTimeline(Request $request)
    {
        if ($request->appointment_id) {
            $users = User::where('deleted_at', null)
                ->where('company_id', Auth::user()->company_id)
                ->get();
            $users = array_column($users->toArray(), 'name', 'id');
            $statuses = Status::whereNull('deleted_at')
                ->where('company_id', Auth::user()->company_id)
                ->get()
                ->keyBy('id');
            $appointment = Appointment::where('deleted_at', null)
                ->where('id', $request->appointment_id)
                ->with('lead')
                ->first();
            $allAppointmentNotes = AppointmentNote::where('appointment_id', $request->appointment_id)
                ->whereNull('deleted_at')
                ->get();
            return view('pages.appointment.appointment-data', compact('appointment', 'statuses', 'users', 'allAppointmentNotes'))->render();
        }
    }

    public function noteStore(Request $request)
    {
        // Validate the request data
        $request->validate([
            'appointment_notes' => 'required|string',
        ]);
        if ($request->appointment_notes && $request->appointment_notes != Null) {
            $implodedUserIds = $request->user_ids ? implode(',', $request->user_ids) : null;
            $userIds = $request->user_ids ?: null;
            AppointmentNote::create([
                'appointment_id' => $request->appointment_id,
                'status_id' => $request->current_status_id,
                'user_id' => Auth::user()->id,
                'user_ids' => $implodedUserIds,
                'unread_ids' => $implodedUserIds,
                'notes' => $request->appointment_notes,
                'created_by' => Auth::user()->id,
            ]);
            // Set new comment flag
            $appointment = Appointment::findOrFail($request->appointment_id);
            $appointment->has_new_comments = 1;
            $appointment->save();

            // Send notification to the appointment tagged users
            if ($userIds && isset($request->nofity)) {
                $this->sendFirebaseNotification($userIds, [
                    'title' => 'You have been tagged in a comment',
                    'body' => ucwords(Auth::user()->name) . ' has mentioned you in a comment.',
                    'click_action' => env('APP_URL') . "appointments/" . $appointment->id . "?show_comments"
                ]);
                // Send email to the appointment tagged users
                if($userIds) { 
                    $users = User::find($userIds); 
                    foreach ($users as $user) { 
                        try {
                            Mail::to($user->email)->send(new UserTagged($appointment, $user));
                            Log::info("Email successfully sent to user Name: {$user->name}");
                        } catch (\Exception $e) {
                            Log::error("Failed to send email to user Name: {$user->name}. Error: " . $e->getMessage());
                        }
                    } 
                }
            }
            return response()->json(['success' => true, 'message' => 'New Comment Added']);
        }
        return response()->json(['failed' => true, 'message' => 'Failed to Add Comment']);
    }

    protected function sendFirebaseNotification($userIds, $notificationData)
    {
        // Dispatch the job for sending Firebase notifications
        SendFirebaseNotification::dispatch($userIds, $notificationData);
    }

    public function markAsRead(Request $request)
    {
        $appointmentNote = AppointmentNote::where('id', $request->noteId)->first();
        $unread_ids = $appointmentNote->unread_ids ? explode(',', $appointmentNote->unread_ids) : [];

        if (($key = array_search(Auth::user()->id, $unread_ids)) !== false) {
            unset($unread_ids[$key]);
            $appointmentNote->unread_ids = implode(',', $unread_ids);
            if (empty($unread_ids)) {
                $appointmentNote->is_read = 1;
            }
            if ($appointmentNote->save()) {
                $appointment = Appointment::findOrFail($appointmentNote->appointment_id);
                $appointment->has_new_comments = 0;
                $appointment->save();
            }
            return response()->json(['success' => true, 'message' => 'Appointment Note marked as read']);
        }
        return response()->json(['failed' => true, 'message' => 'Failed to Appointment Note marked as read']);
    }

    public function viewStatusComments(Request $request)
    {
        if ($request->appointment_id && $request->status_id) {
            $users = User::where('deleted_at', null)
                ->where('company_id', Auth::user()->company_id)
                ->get();
            $users = array_column($users->toArray(), 'name', 'id');
            $statusName = $request->status_name;
            $appointmentNotes = AppointmentNote::where('appointment_id', $request->appointment_id)
            ->where('status_id', $request->status_id)
            ->with('status')
            ->whereNull('deleted_at')
                ->get();
            return view('pages.appointment.status-comment', compact('users', 'appointmentNotes', 'statusName'))->render();
        }
    }

    public function getLeadAddress(Request $request)
    {
        if ($request->leadId) {
            $lead = Lead::find($request->leadId);
             
                // Retrieve state color
                $state = State::leftJoin('state_colours', 'states.id', '=', 'state_colours.state_id')
                ->where('states.id', $lead->state_id)
                ->select('states.id', 'states.name', 'state_colours.color_code')
                ->first();

            return response()->json([
                'lead' => $lead,
                'state_color' => $state ? $state->color_code : null
            ]);
        }
        return response()->json(['lead' => '']);
    }
}
