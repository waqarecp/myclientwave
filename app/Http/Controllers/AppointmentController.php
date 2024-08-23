<?php

namespace App\Http\Controllers;

use App\DataTables\AppointmentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentNote;
use App\Models\Timeline;
use App\Models\TimelineDocs;
use App\Models\User;
use App\Models\Status;
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
    public function update(Request $request, Appointment $appointment)
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
                    $timeline = Timeline::findOrFail($timelineId);
                    $timeline->timeline_date = $request->timeline_date;
                    $timeline->save();
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

    public function updateTimeline(Request $request)
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
                ->with('timeline')
                ->with('appointmentNotes')
                ->first();
            $appointmentNotes = AppointmentNote::where('appointment_id', $request->appointment_id)
                ->whereNull('deleted_at')
                ->get();
            $allAppointmentNotes = [];
            foreach ($appointmentNotes as $note) {
                $allAppointmentNotes[$note->status_id][] = $note;
            }
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
            if (isset($request->user_ids) && $request->user_ids != null) {
                $userIds = implode(',', $request->user_ids);
            }
            AppointmentNote::create([
                'appointment_id' => $request->appointment_id,
                'status_id' => $request->current_status_id,
                'user_id' => Auth::user()->id,
                'user_ids' => $userIds ?: null,
                'unread_ids' => $userIds ?: null,
                'notes' => $request->appointment_notes,
                'created_by' => Auth::user()->id,
            ]);
            // Set new comment flag
            $appointment = Appointment::findOrFail($request->appointment_id);
            $appointment->has_new_comments = 1;
            $appointment->save();

            return response()->json(['success' => true, 'message' => 'New Comment Added']);
        }
        return response()->json(['failed' => true, 'message' => 'Failed to Add Comment']);
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
}
