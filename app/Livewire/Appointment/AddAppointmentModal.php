<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Lead;
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
    public $appointment_city;
    public $appointment_state;
    public $appointment_zip;
    public $appointment_country;
    public $appointment_address_1;
    public $appointment_address_2;

    public $edit_mode = false;

    protected $rules = [
        'lead_id' => 'integer|required',
        'representative_user' => 'integer|required',
        'appointment_date' => 'required|date',
        'appointment_time' => 'required|string',
        'appointment_street' => 'nullable|string|max:255',
        'appointment_city' => 'nullable|string|max:100',
        'appointment_state' => 'nullable|string|max:100',
        'appointment_zip' => 'nullable|string|max:20',
        'appointment_country' => 'required|string',
        'appointment_address_1' => 'required|string',
        'appointment_address_2' => 'nullable|string',
    ];

    protected $listeners = [
        'delete_appointment' => 'deleteAppointment',
        'get_data' => 'getData',
        'new_appointment' => 'hydrate',
        'reset_form' => 'resetForm'
    ];

    #[On('getLeadAddress')]
    public function getLeadAddress($leadId): void
    {
        if ($leadId) {
            $lead = Lead::find($leadId);
            $this->appointment_street = $lead->street;
            $this->appointment_city = $lead->city;
            $this->appointment_state = $lead->state;
            $this->appointment_zip = $lead->zip;
            $this->appointment_country = $lead->country;
            $this->appointment_address_1 = $lead->address_1;
            $this->appointment_address_2 = $lead->address_2;
        } else {
            $this->appointment_street = null;
            $this->appointment_city = null;
            $this->appointment_state = null;
            $this->appointment_zip = null;
            $this->appointment_country = null;
            $this->appointment_address_1 = null;
            $this->appointment_address_2 = null;
         }
    }

    public function render()
    {
        $users = User::where('deleted_at', null)->get();
        $leads = Lead::where('deleted_at', null)->get();
        return view('livewire.appointment.add-appointment-modal', compact('users', 'leads'));
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
                'appointment_city' => $this->appointment_city,
                'appointment_state' => $this->appointment_state,
                'appointment_zip' => $this->appointment_zip,
                'appointment_country' => $this->appointment_country,
                'appointment_address_1' => $this->appointment_address_1,
                'appointment_address_2' => $this->appointment_address_2,
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
            $appointment->appointment_city = $this->appointment_city;
            $appointment->appointment_state = $this->appointment_state;
            $appointment->appointment_zip = $this->appointment_zip;
            $appointment->appointment_country = $this->appointment_country;
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
        $this->appointment_city = $appointment->appointment_city;
        $this->appointment_state = $appointment->appointment_state;
        $this->appointment_zip = $appointment->appointment_zip;
        $this->appointment_country = $appointment->appointment_country;
        $this->appointment_address_1 = $appointment->appointment_address_1;
        $this->appointment_address_2 = $appointment->appointment_address_2;
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
