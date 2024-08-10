<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Lead;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddAppointmentModal extends Component
{
    public $appointment_id;
    public $lead_id;
    public $representative_user;
    public $appointment_date;
    public $appointment_time;
    public $appointment_notes;

    public $edit_mode = false;

    protected $rules = [
        'lead_id' => 'integer|required',
        'representative_user' => 'integer|required',
        'appointment_date' => 'required|date',
        'appointment_time' => 'required|string',
        'appointment_notes' => 'required|string',
    ];

    protected $listeners = [
        'delete_appointment' => 'deleteAppointment',
        'get_data' => 'getData',
        'new_appointment' => 'hydrate',
        'reset_form' => 'resetForm'
    ];

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
                'appointment_notes' => $this->appointment_notes,
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
            $appointment->appointment_notes = $this->appointment_notes;

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
        $this->appointment_notes = $appointment->appointment_notes;
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
