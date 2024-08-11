<?php

namespace App\Http\Controllers;

use App\DataTables\AppointmentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Appointment;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CalendarController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(AppointmentDataTable $dataTable)
    {
        $appointments = Appointment::whereNull('deleted_at')->with('lead')->with('user')->get();
        $calendarData = $appointments->map(function ($appointment) {
            // Define className based on appointment date
            if ($appointment->appointment_date == date('Y-m-d')) {
                $className = 'border-success bg-success text-inverse-success';
            } 
            if ($appointment->appointment_date < date('Y-m-d')) {
                $className = 'border-warning bg-warning text-inverse-success';
            } 
            if ($appointment->appointment_date > date('Y-m-d')){
                $className = 'border-info bg-info text-inverse-success';
            }
            return [
                'id' => $appointment->id,
                'title' => $appointment->lead->first_name . ' ' .$appointment->lead->last_name,
                'start' => $appointment->appointment_date . ' ' .$appointment->appointment_time,
                'end' => Carbon::parse($appointment->appointment_date)->addDay()->format('d F Y'),
                'description' => $appointment->appointment_notes,
                'className' => $className,
                'location' => "Street: ".$appointment->lead->street . ' City: ' . $appointment->lead->city . ' State: ' . $appointment->lead->state . ' Country: ' . $appointment->lead->country,
                'created_by' => $appointment->user->name,
            ];
        });
        return $dataTable->render('pages/calendar/list', ['calendarData' => $calendarData->toJson(),]);
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
        return view('pages/calendar/show', compact('appointment'));
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
