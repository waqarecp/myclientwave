<?php

namespace App\Http\Controllers;

use App\Jobs\SendFirebaseNotification;
use App\Http\Controllers\Controller;
use App\Mail\CommentReaction;
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
use App\Models\Setting;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
        $statuses = Status::where('company_id', Auth::user()->company_id)->get();

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
        $appointmentsQuery = Appointment::join('leads', 'appointments.lead_id', '=', 'leads.id')
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
            if (!empty($searchTerm)) {
                $appointmentsQuery->where(function($q) use ($searchTerm) {
                    // If the search term is numeric, search by ID and phone number
                    if (is_numeric($searchTerm)) {
                        $q->Where('leads.phone', 'LIKE', "%{$searchTerm}%");
                    } elseif (strpos($searchTerm, '@') !== false) {
                        $q->where('leads.email', 'LIKE', "%{$searchTerm}%");
                    } elseif (preg_match('/^[a-zA-Z\s]+$/', $searchTerm)) {
                        $q->where('leads.first_name', 'LIKE', "{$searchTerm}%")
                        ->orWhere('leads.last_name', 'LIKE', "{$searchTerm}%")
                        ->orWhere(DB::raw("CONCAT(leads.first_name, ' ', leads.last_name)"), 'LIKE', "%{$searchTerm}%");
                    }
                });
            }
        }

        $appointmentsQuery->where("leads.company_id", "=", $companyId);
        // Apply date filters
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        if (!empty($dateFrom) && !empty($dateTo)) {
            $appointmentsQuery->whereBetween('appointments.created_at', [$dateFrom, $dateTo]);
        } elseif (!empty($dateFrom)) {
            $appointmentsQuery->where('appointments.created_at', '>=', $dateFrom);
        } elseif (!empty($dateTo)) {
            $appointmentsQuery->where('appointments.created_at', '<=', $dateTo);
        }

        // Apply filter by appointment status
        $filterStatus = $request->input('filter_status');
        if (!empty($filterStatus)) {
            $appointmentsQuery->where('appointments.status_id', '=', $filterStatus);
        }
        // Paginate the results
        $rows = $appointmentsQuery->paginate(15)->withQueryString();

        // Return the view with paginated data
        return view('pages.appointment.list', compact('users', 'leads', 'roles', 'countries', 'rows', 'statuses'));
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
            $appointmentNote = AppointmentNote::create([
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
            if ($userIds && isset($request->notify)) {
                $senderUser = auth()->user();
                $receiverUsers = User::whereIn('id', $userIds)->get();
            
                // Firebase notify
                $this->sendFirebaseNotification($userIds, [
                    'title' => 'You have been tagged in a comment',
                    'body' => ucwords($senderUser->name) . ' has mentioned you in a comment.',
                    'click_action' => env('APP_URL') . "appointments/" . $appointment->id . "?show_comments"
                ]);
        
                // Email notify
                DB::beginTransaction();
                try {
                    // Set comment in appointment variable
                    $appointmentComment = $request->appointment_notes;
                    $appointmentNoteCreatedAt = \Carbon\Carbon::parse($appointmentNote->created_at)->format('d M Y h:i a');
                    foreach ($receiverUsers as $taggedUser) {
                        if ($taggedUser && $taggedUser->email) {
                            // Queue the email for sending
                            Mail::to($taggedUser->email)->queue(new UserTagged($appointment, $appointmentComment, $appointmentNoteCreatedAt, $senderUser, $taggedUser));
                            // Log::info("Queued email successfully for user Name: {$taggedUser->name}, Email: {$taggedUser->email}");
                        } else {
                            // Log::error("Receiver user or email is missing for user ID: " . ($taggedUser->id ?: 'unknown'));
                        }
                    }
        
                    DB::commit(); // Commit transaction if all goes well
                } catch (\Exception $e) {
                    DB::rollBack(); // Rollback transaction in case of error
                    Log::error("Failed to send emails. Error: " . $e->getMessage());
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

    public function reactToComment(Request $request)
    {
        $appointmentNote = AppointmentNote::findOrFail($request->commentId);
        $reactions = $appointmentNote->reactions ? json_decode($appointmentNote->reactions, true) : [];
        $isFirstTimeReaction = true;
        $userReactionExists = false;
        foreach ($reactions as $key => $reaction) {
            if ($reaction['user_id'] == Auth::user()->id) {
                $reactions[$key]['reactionType'] = $request->reactionType;
                $userReactionExists = true;
                $isFirstTimeReaction = false;
            }
        }
        if (!$userReactionExists) {
            $reactions[] = [
                'user_id' => Auth::user()->id,
                'reactionType' => $request->reactionType
            ];
        }
        $appointmentNote->reactions = json_encode($reactions);
        if ($appointmentNote->save()) {
            if ($isFirstTimeReaction) {
                $appointment = Appointment::find($appointmentNote->appointment_id);
                $comment = strip_tags($appointmentNote->notes);
                $senderUser = Auth::user();
                $receiverUser = $appointmentNote->created_by;
                $reactionType = $request->reactionType;
                $this->sendFirebaseNotification([$receiverUser], [
                    'title' => ucwords($senderUser->name) . getReactionEmojis()[$reactionType] . ' reacted to your comment',
                    'body' => $comment,
                    'click_action' => env('APP_URL') . "appointments/" . $appointment->id . "?show_comments"
                ]);
                DB::beginTransaction();
                try {
                    $appointmentComment = $appointmentNote->notes;
                    $appointmentNoteCreatedAt = Carbon::parse($appointmentNote->created_at)->format('d M Y h:i a');
                    $receiver = User::find($receiverUser);
                    if ($receiver && $receiver->email) {
                        Mail::to($receiver->email)->queue(new CommentReaction($appointment, $appointmentComment, $reactionType, $appointmentNoteCreatedAt, $senderUser, $receiver));
                    }
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error("Failed to send email for reaction. Error: " . $e->getMessage());
                }
            }

            return response()->json(['success' => true, 'reactions' => $reactions, 'message' => 'Reaction added successfully']);
        }

        return response()->json(['failed' => true, 'message' => 'Failed to add reaction']);
    }

    public function viewComments(Request $request)
    {
        if ($request->appointment_id) {
            $users = User::where('deleted_at', null)
                ->where('company_id', Auth::user()->company_id)
                ->get();
            $users = array_column($users->toArray(), 'name', 'id');
            $appointmentNotes = AppointmentNote::where('appointment_id', $request->appointment_id)
            ->whereNull('deleted_at')
                ->get();
            return view('pages.appointment.comment', compact('users', 'appointmentNotes'))->render();
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
    
    public function export(Request $request)
    {
        $dateTime = Carbon::now()->format('Y-m-d_h-i-s-a');
        $fileName = 'appointments_'.$dateTime.'.csv';
        
        $appointments = Appointment::join('leads', 'appointments.lead_id', '=', 'leads.id')
        ->select(
            'appointments.*',
            'leads.first_name',
            'leads.last_name',
            'leads.phone',
            'leads.email',
            'leads.mobile',
            'leads.company_id'
        );
        if ($request->has('search') && !empty($request->search)) {
            $appointments->where(function($query) use ($request) {
                $query->where('leads.first_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('leads.last_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere(DB::raw("CONCAT(leads.first_name, ' ', leads.last_name)"), 'LIKE', '%' . $request->search . '%')
                    ->orWhere('leads.phone', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('leads.email', 'LIKE', '%' . $request->search . '%');
            });
        }
    
        if ($request->has('date_from') && !empty($request->date_from)) {
            $appointments->whereDate('appointments.created_at', '>=', $request->date_from);
        }
    
        if ($request->has('date_to') && !empty($request->date_to)) {
            $appointments->whereDate('appointments.created_at', '<=', $request->date_to);
        }
    
        if ($request->has('filter_status') && !empty($request->filter_status)) {
            $appointments->where('appointments.status_id', $request->filter_status);
        }
    
        $appointments = $appointments->whereNull('appointments.deleted_at')->where("leads.company_id", "=", Auth::user()->company_id)->get();
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        $callback = function() use ($appointments) {
            $file = fopen('php://output', 'w');

            // Set the header row
            fputcsv($file, ['Sr. No.', 'Lead Name', 'Lead Email', 'Lead Phone', 'Appointment Date', 'Appointment Time', 'Appointment Address', 'Appointment Status', 'Created By', 'Created At']);

            // Set the data rows
            $counter = 1;
            foreach ($appointments as $appointment) {
                $appointmentAddress = implode(', ', array_filter([
                        optional($appointment->country)->name,
                        optional($appointment->state)->name,
                        optional($appointment->city)->name,
                        $appointment->appointment_address_1,
                        $appointment->appointment_address_2,
                        $appointment->appointment_street,
                        $appointment->appointment_zip
                    ]));
                fputcsv($file, [
                    $counter++,
                    optional($appointment->lead)->first_name . ' ' . optional($appointment->lead)->last_name,
                    optional($appointment->lead)->email,
                    optional($appointment->lead)->phone,
                    Carbon::parse($appointment->appointment_date)->format('d M Y'),
                    $appointment->appointment_time,
                    $appointmentAddress,
                    optional($appointment->status)->status_name,
                    optional($appointment->user)->name,
                    Carbon::parse($appointment->created_at)->format('d M Y H:i'),
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
