<?php

namespace App\Http\Controllers;

use App\DataTables\AppointmentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Lead;
use App\Models\Role;
use App\Models\Country;
use App\Models\State;
use App\Models\Setting;
use App\Models\StateColour;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(AppointmentDataTable $dataTable)
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
        $countries = Country::whereIn('id', $assignedCountryIds)->pluck('name', 'id')->toArray();

         // Fetch states for assigned countries
        $states = State::whereIn('country_id', $assignedCountryIds)->pluck('name', 'id')->toArray();

        // Fetch appointments with eager loading
        $appointments = Appointment::with(['lead', 'user', 'country', 'state', 'city'])
            ->whereIn('appointments.appointment_country_id', array_keys($countries))
            ->whereNull('appointments.deleted_at')
            ->whereHas('lead', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->get();

       $stateColorQuery = StateColour::where('state_colours.company_id', $companyId)
            ->whereIn('state_colours.state_id', array_keys($states))
            ->join('states', 'state_colours.state_id', '=', 'states.id')
            ->whereNull('state_colours.deleted_at')
            ->get();

        foreach ($appointments as $appointment) {
            $appointment->stateColour = $stateColorQuery->where('state_id', $appointment->appointment_state_id)->first();
        }
        $calendarData = $appointments->map(function ($appointment) {
            $description = $appointment->has_new_comments == 1 ? 'New updates posted for this appointment' : 'No new updates';

            return [
                'id' => $appointment->id,
                'leadId' => $appointment->lead_id,
                'title' => optional($appointment->lead)->first_name . ' ' . optional($appointment->lead)->last_name,
                'start' => $appointment->appointment_date . ' ' . $appointment->appointment_time,
                'end' => Carbon::parse($appointment->appointment_date)->addDay()->format('d F Y'),
                'description' => $description,
                'colorCode' => optional($appointment->stateColour)->color_code, // Pass color code to JS
                'location' => 
                    (implode(', ', array_filter([
                        optional($appointment->country)->name,
                        optional($appointment->state)->name,
                        optional($appointment->city)->name,
                        $appointment->appointment_address_1,
                        $appointment->appointment_address_2,
                        $appointment->appointment_street,
                        $appointment->appointment_zip
                    ]))),
                'created_by' => optional($appointment->user)->name,
                'has_new_comments' => $appointment->has_new_comments,
            ];
        });

        return $dataTable->render('pages/calendar/list', ['users' => $users, 'leads' => $leads, 'roles' => $roles, 'countries' => $countries, 'calendarData' => $calendarData->toJson()]);
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
