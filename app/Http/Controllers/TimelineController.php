<?php

namespace App\Http\Controllers;

use App\DataTables\TimelineDataTable;
use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Status;
use App\Models\Timeline;
use App\Models\TimelineDocs;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TimelineDataTable $dataTable)
    {
        return $dataTable->render('pages/timeline/list');
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
    public function show(Timeline $timeline)
    {
        return view('pages/timeline/show', compact('timeline'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timeline $timeline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Timeline $timeline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timeline $timeline)
    {
        //
    }

    public function getData(Request $request)
    {
        if ($request->lead_id) {
            $users = User::where('deleted_at', null)
                ->where('company_id', Auth::user()->company_id)
                ->get();
            $users = array_column($users->toArray(), 'name', 'id');

            $lead = Lead::where('deleted_at', null)
                ->where('id', $request->lead_id)
                ->first();

            if ($lead) {
                $lead = Lead::where('deleted_at', null)
                ->where('id', $request->lead_id)
                ->with('timeline.timelineDocs')
                ->first();

                $statuses = Status::whereNull('deleted_at')
                    ->where('company_id', Auth::user()->company_id)
                    ->get()
                    ->keyBy('id');

                $timelineNotes = Note::where('lead_id', $request->lead_id)
                    ->whereNull('deleted_at')
                    ->get();
                $allLeadNotes = [];
                foreach ($timelineNotes as $note) {
                    $allLeadNotes[$note->timeline_id][] = $note;
                }

                return view('pages.timeline.timeline-data', compact('lead', 'statuses', 'users', 'allLeadNotes'))->render();
            }
        }
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

    public function viewComment(Request $request)
    {
        if ($request->timeline_id) {
            $users = User::where('deleted_at', null)
                ->where('company_id', Auth::user()->company_id)
                ->get();
            $users = array_column($users->toArray(), 'name', 'id');
            $timelineNotes = Note::where('timeline_id', $request->timeline_id)
                ->whereNull('deleted_at')
                ->get();
            return view('pages.timeline.timeline-comment', compact('users', 'timelineNotes'))->render();
        }
    }
}
