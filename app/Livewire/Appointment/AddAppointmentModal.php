<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Lead;
use App\Models\Role;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class AddAppointmentModal extends Component
{
    public $appointment_id;
    public $lead_id;
    public $representative_user;
    public $appointment_date;
    public $appointment_time;
    public $appointment_street;
    public $appointment_country_id;
    public $appointment_state_id;
    public $appointment_city_id;
    public $appointment_zip;
    public $appointment_address_1;
    public $appointment_address_2;
    public $states = [];
    public $cities = [];

    public $edit_mode = false;

    protected $rules = [
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
    ];

    protected $listeners = [
        'delete_appointment' => 'deleteAppointment',
        'get_data' => 'getData',
        'new_appointment' => 'hydrate',
        'reset_form' => 'resetForm'
    ];

    public function render()
    {
        $users = User::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $leads = Lead::where('deleted_at', null)->get();
        $roles = Role::all();
        $countries = Country::active()->pluck('name', 'id');
        // Check if country_id is set and fetch states accordingly
        if ($this->appointment_country_id) {
            $this->states = State::where('country_id', $this->appointment_country_id)
                ->leftJoin('state_colours', 'states.id', '=', 'state_colours.state_id')
                ->get(['states.id', 'states.name', 'state_colours.color_code']);
        }

        // Check if state_id is set and fetch cities accordingly
        if ($this->appointment_state_id) {
            $this->cities = City::where('state_id', $this->appointment_state_id)->pluck('name', 'id')->toArray();
        }
        return view('livewire.appointment.add-appointment-modal', compact('users', 'leads', 'roles', 'countries'));
    }

    public function createAppointment()
    {
        $errorMessage = null;
        $this->validate();

        DB::transaction(function () use ($errorMessage) {
            // Prepare the data for creating a new user
            $data = [
                'lead_id' => $this->lead_id,
                'company_id' => Auth::user()->company_id,
                'representative_user' => $this->representative_user,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
                'appointment_street' => $this->appointment_street,
                'appointment_country_id' => $this->appointment_country_id,
                'appointment_state_id' => $this->appointment_state_id,
                'appointment_city_id' => $this->appointment_city_id,
                'appointment_zip' => $this->appointment_zip,
                'appointment_address_1' => $this->appointment_address_1,
                'appointment_address_2' => $this->appointment_address_2,
                'timeline_date' => date('Y-m-d'),
                'created_by' => Auth::user()->id,
            ];
            $appointment = Appointment::create($data);
            if ($appointment) {
                // Emit a success event with a message
                $this->dispatch('success', __('New Appointment created ' . $errorMessage));
            } else {
                $this->dispatch('error', __('Failed to create new Appointment'));
            }
        });
        // Reset the form fields after successful submission
        $this->reset();
    }

    public function updateAppointment()
    {
        $this->validate();

        DB::transaction(function () {

            $appointment = Appointment::findOrFail($this->appointment_id);
            $appointment->lead_id = $this->lead_id;
            $appointment->representative_user = $this->representative_user;
            $appointment->appointment_date = $this->appointment_date;
            $appointment->appointment_time = $this->appointment_time;
            $appointment->appointment_street = $this->appointment_street;
            $appointment->appointment_country_id = $this->appointment_country_id;
            $appointment->appointment_state_id = $this->appointment_state_id;
            $appointment->appointment_city_id = $this->appointment_city_id;
            $appointment->appointment_zip = $this->appointment_zip;
            $appointment->appointment_address_1 = $this->appointment_address_1;
            $appointment->appointment_address_2 = $this->appointment_address_2;

            if ($appointment->save()) {
                // Emit a success event with a message
                $this->dispatch('success', __('Appointment updated successfully'));
                // Reset the form fields after successful submission
                $this->reset();
            } else {
                $this->dispatch('error', __('Failed to update Appointment'));
            }
        });
    }

    public function deleteAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->deleted_at = now();
        $appointment->save();

        // Emit a success event with a message
        $this->dispatch('success', 'Appointment successfully deleted');
    }

    public function getData($id)
    {
        $this->edit_mode = true;

        $appointment = Appointment::find($id);

        $this->appointment_id = $appointment->id;
        $this->lead_id = $appointment->lead_id;
        $this->representative_user = $appointment->representative_user;
        $this->appointment_date = $appointment->appointment_date;
        $this->appointment_time = $appointment->appointment_time;
        $this->appointment_street = $appointment->appointment_street;
        $this->appointment_country_id = $appointment->appointment_country_id;
        $this->appointment_state_id = $appointment->appointment_state_id;
        $this->appointment_city_id = $appointment->appointment_city_id;
        $this->appointment_zip = $appointment->appointment_zip;
        $this->appointment_address_1 = $appointment->appointment_address_1;
        $this->appointment_address_2 = $appointment->appointment_address_2;
    }

    #[On('getLeadAddress')]
    public function getLeadAddress($leadId): void
    {
        if ($leadId) {
            $lead = Lead::find($leadId);
            $this->appointment_street = $lead->street;
            $this->appointment_country_id = $lead->country_id;
            $this->appointment_state_id = $lead->state_id;
            $this->appointment_city_id = $lead->city_id;
            $this->appointment_zip = $lead->zip;
            $this->appointment_address_1 = $lead->address_1;
            $this->appointment_address_2 = $lead->address_2;
        } else {
            $this->appointment_street = null;
            $this->appointment_country_id = null;
            $this->appointment_state_id = null;
            $this->appointment_city_id = null;
            $this->appointment_zip = null;
            $this->appointment_address_1 = null;
            $this->appointment_address_2 = null;
         }
    }
    
    #[On('getStates')]
    public function getStates($countryId)
    {
        if ($countryId) {
            $states = State::where('country_id', $countryId)
                ->leftJoin('state_colours', 'states.id', '=', 'state_colours.state_id')
                ->get(['states.id', 'states.name', 'state_colours.color_code']);
    
            // Format the states as key-value pairs with color codes
            $formattedStates = [];
            foreach ($states as $state) {
                $formattedStates[] = [
                    'id' => $state->id,
                    'name' => $state->name,
                    'color_code' => $state->color_code,
                ];
            }
    
            return response()->json(['states' => $formattedStates]);
        }
    
        return response()->json(['states' => []]);
    }
    
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->reset();
    }
}
