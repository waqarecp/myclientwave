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
    public $lead_source_id;
    public $appointment_sat = 0;
    public $street;
    public $city;
    public $state;
    public $zip;
    public $country;
    public $notes;
    public $address_1;
    public $address_2;
    
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
        'lead_source_id' => 'nullable|integer',
        'appointment_sat' => 'nullable|boolean',
        'street' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:100',
        'state' => 'nullable|string|max:100',
        'zip' => 'nullable|string|max:20',
        'country' => 'required|string',
        'notes' => 'nullable|string',
        'address_1' => 'required|string',
        'address_2' => 'nullable|string',
    ];

    protected $listeners = [
        'delete_lead' => 'deleteLead',
        'get_data' => 'getData',
        'new_lead' => 'hydrate',
        'reset_form' => 'resetForm'
    ];

    public function render()
    {
        $users = User::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $utilitycompanies = UtilityCompany::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $companies = Company::where('deleted_at', null)->get();
        $sources = LeadSource::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $appointment = Appointment::where('deleted_at', null)->with('lead')->get();
        $note = Note::where('deleted_at', null)->get();
        return view('livewire.lead.add-lead-modal',compact('users', 'utilitycompanies', 'companies', 'sources', 'appointment', 'note'));
    }

    public function createLead()
    {
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
            $lead->lead_source_id = $this->lead_source_id;
            $lead->street = $this->street;
            $lead->city = $this->city;
            $lead->state = $this->state;
            $lead->zip = $this->zip;
            $lead->country = $this->country;
            $lead->address_1 = $this->address_1;
            $lead->address_2 = $this->address_2;

            if ($lead->save()) {
                // Emit a success event with a message
                $this->dispatch('success', __('Lead updated successfully'));
                // Reset the form fields after successful submission
                $this->reset();
            } else {
                $this->dispatch('error', __('Failed to update this lead'));
            }
        });
    }

    public function deleteLead($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->deleted_at = now();
        $lead->save();

        // Emit a success event with a message
        $this->dispatch('success', 'Lead successfully deleted');
    }

    public function getData($id)
    {
        $this->edit_mode = true;

        $lead = Lead::find($id);
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
        $this->lead_source_id = $lead->lead_source_id;
        $this->appointment_sat = $lead->appointment_sat == 1 ?: 0;
        $this->street = $lead->street;
        $this->city = $lead->city;
        $this->state = $lead->state;
        $this->zip = $lead->zip;
        $this->country = $lead->country;
        $this->address_1 = $lead->address_1;
        $this->address_2 = $lead->address_2;
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
