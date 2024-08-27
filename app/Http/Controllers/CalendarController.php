<?php

namespace App\Http\Controllers;

use App\DataTables\AppointmentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
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
             // Check if there are new comments
             $description = "";
            if ($appointment->has_new_comments == 1) {
                $className = 'border-danger bg-danger text-inverse-danger';
                $description = 'New updates posted for this appointment';
            } else {
                if ($appointment->appointment_date == date('Y-m-d')) {
                    $className = 'border-success bg-success text-inverse-success';
                } elseif ($appointment->appointment_date < date('Y-m-d')) {
                    $className = 'border-warning bg-warning text-inverse-success';
                } else {
                    $className = 'border-info bg-info text-inverse-success';
                }
            }

            return [
                'id' => $appointment->id,
                'title' => $appointment->lead->first_name . ' ' . $appointment->lead->last_name,
                'start' => $appointment->appointment_date . ' ' . $appointment->appointment_time,
                'end' => Carbon::parse($appointment->appointment_date)->addDay()->format('d F Y'),
                'description' => $description,
                'className' => $className,
                'location' => "Country: " . $appointment->lead->country . "\n" .
                "State: " . $appointment->lead->state . "\n" .
                "City: " . $appointment->lead->city . "\n" .
                "Street: " . $appointment->lead->street,                
                'created_by' => $appointment->user->name,
                'has_new_comments' => $appointment->has_new_comments,
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
