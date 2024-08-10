<?php

namespace App\Livewire\Lead;

use App\Models\Lead;
use App\Models\User;
use App\Models\UtilityCompany;
use App\Models\Company;
use App\Models\LeadSource;
use App\Models\Appointment;
use App\Models\Note;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddLeadModal extends Component
{
    public $lead_id;
    public $owner_id;
    public $first_name;
    public $last_name;
    public $sale_representative;
    public $mobile;
    public $phone;
    public $email;
    public $utility_company_id;
    public $call_center_representative;
    public $lead_status;
    public $lead_source_id;
    public $appointment_sat = 0;
    public $appointment_date;
    public $appointment_time;
    public $street;
    public $city;
    public $state;
    public $zip;
    public $country;
    public $appointment_notes;
    public $notes;

    public $edit_mode = false;

    protected $rules = [
        'owner_id' => 'required|integer',
        'sale_representative' => 'nullable|integer',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'mobile' => 'required|string|max:15',
        'phone' => 'nullable|string|max:15',
        'email' => 'required|email|max:255',
        'utility_company_id' => 'nullable|integer',
        'call_center_representative' => 'nullable|integer',
        'lead_status' => 'required|integer',
        'lead_source_id' => 'nullable|integer',
        'appointment_sat' => 'nullable|boolean',
        'appointment_date' => 'nullable|date',
        'appointment_time' => 'nullable|string',
        'street' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:100',
        'state' => 'nullable|string|max:100',
        'zip' => 'nullable|string|max:20',
        'country' => 'nullable|string|max:100',
        'appointment_notes' => 'nullable|string',
        'notes' => 'nullable|string',
    ];

    protected $listeners = [
        'delete_lead' => 'deleteLead',
        'get_data' => 'getData',
        'new_lead' => 'hydrate',
        'reset_form' => 'resetForm'
    ];

    public function render()
    {
        $users = User::where('deleted_at', null)->get();
        $utilitycompanies = UtilityCompany::where('deleted_at', null)->get();
        $companies = Company::where('deleted_at', null)->get();
        $sources = LeadSource::where('deleted_at', null)->get();
        $appointment = Appointment::where('deleted_at', null)->with('lead')->get();
        $note = Note::where('deleted_at', null)->get();
        return view('livewire.lead.add-lead-modal',compact('users', 'utilitycompanies', 'companies', 'sources', 'appointment', 'note'));
    }

    public function createLead()
    {
        $errorMessage = null;
        $this->validate();

        DB::transaction(function () use ($errorMessage) {
            // Prepare the data for creating a new user
            $data = [
                'company_id' => Auth::user()->company_id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'owner_id' => $this->owner_id,
                'sale_representative' => $this->sale_representative,
                'mobile' => $this->mobile,
                'phone' => $this->phone,
                'email' => $this->email,
                'utility_company_id' => $this->utility_company_id,
                'call_center_representative' => $this->call_center_representative,
                'lead_status' => $this->lead_status,
                'lead_source_id' => $this->lead_source_id,
                'appointment_sat' => $this->appointment_sat ?: 0,
                'street' => $this->street,
                'city' => $this->city,
                'state' => $this->state,
                'zip' => $this->zip,
                'country' => $this->country,
                'created_at' => now(),
                'created_by' => Auth::user()->id,
            ];

            $lead = Lead::create($data);
            if ($lead) {
                // Create associated Appointment and Note records
                Appointment::create([
                    'lead_id' => $lead->id,
                    'company_id' => Auth::user()->company_id,
                    'representative_user' => $this->call_center_representative,
                    'appointment_date' => $this->appointment_date,
                    'appointment_time' => $this->appointment_time,
                    'appointment_notes' => $this->appointment_notes,
                    'created_by' => Auth::user()->id,
                ]);

                Note::create([
                    'lead_id' => $lead->id,
                    'company_id' => Auth::user()->company_id,
                    'user_id' => Auth::user()->id,
                    'notes' => $this->notes,
                    'created_by' => Auth::user()->id,
                ]);
                // Emit a success event with a message
                $this->dispatch('success', __('New lead created ' . $errorMessage));
            } else {
                $this->dispatch('error', __('Failed to create new lead'));
            }

        });
        // Reset the form fields after successful submission
        $this->reset();
    }

    public function updateLead()
    {
        $this->validate();

        DB::transaction(function () {

            $lead = Lead::findOrFail($this->lead_id);
            $lead->first_name = $this->first_name;
            $lead->last_name = $this->last_name;
            $lead->owner_id = $this->owner_id;
            $lead->sale_representative = $this->sale_representative;
            $lead->mobile = $this->mobile;
            $lead->phone = $this->phone;
            $lead->email = $this->email;
            $lead->utility_company_id = $this->utility_company_id;
            $lead->call_center_representative = $this->call_center_representative;
            $lead->lead_status = $this->lead_status;
            $lead->lead_source_id = $this->lead_source_id;
            $lead->appointment_sat = $this->appointment_sat ?: 0;
            $lead->street = $this->street;
            $lead->city = $this->city;
            $lead->state = $this->state;
            $lead->zip = $this->zip;
            $lead->country = $this->country;

            if ($lead->save()) {
                $appointment = Appointment::findOrFail($lead->id);
                $appointment->appointment_date = $this->appointment_date;
                $appointment->appointment_time = $this->appointment_time;
                $appointment->appointment_notes = $this->appointment_notes;
                $appointment->save();

                $note = Note::findOrFail($lead->id);
                $note->notes = $this->notes;
                $note->save();
                // Emit a success event with a message
                $this->dispatch('success', __('lead updated successfully'));
                // Reset the form fields after successful submission
                $this->reset();
            } else {
                $this->dispatch('error', __('Failed to update lead'));
            }
        });
    }

    public function deleteLead($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->deleted_at = now();
        if($lead->save()) {
            $appointment = Appointment::findOrFail($lead->id);
            $appointment->deleted_at = now();
            $appointment->save();
            
            $note = Note::findOrFail($lead->id);
            $note->deleted_at = now();
            $note->save();
        }

        // Emit a success event with a message
        $this->dispatch('success', 'Lead successfully deleted');
    }

    public function getData($id)
    {
        $this->edit_mode = true;

        $lead = Lead::find($id);
        if ($lead) {
            $appointment = Appointment::find($lead->id);
            $note = Note::find($lead->id);
        }
        $this->lead_id = $lead->id;
        $this->owner_id = $lead->owner_id;
        $this->first_name = $lead->first_name;
        $this->last_name = $lead->last_name;
        $this->sale_representative = $lead->sale_representative;
        $this->mobile = $lead->mobile;
        $this->phone = $lead->phone;
        $this->email = $lead->email;
        $this->utility_company_id = $lead->utility_company_id;
        $this->call_center_representative = $lead->call_center_representative;
        $this->lead_status = $lead->lead_status;
        $this->lead_source_id = $lead->lead_source_id;
        $this->appointment_sat = $lead->appointment_sat == 1 ?: 0;
        $this->appointment_date = $appointment->appointment_date;
        $this->appointment_time = $appointment->appointment_time;
        $this->street = $lead->street;
        $this->city = $lead->city;
        $this->state = $lead->state;
        $this->zip = $lead->zip;
        $this->country = $lead->country;
        $this->appointment_notes = $appointment->appointment_notes;
        $this->notes = $note->notes;
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
