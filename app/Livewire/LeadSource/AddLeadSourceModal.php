<?php

namespace App\Livewire\LeadSource;

use App\Models\LeadSource;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddLeadSourceModal extends Component
{
    public $leadsource_id;
    public $source_name;

    public $edit_mode = false;

    protected $rules = [
        'source_name' => 'required|string'
    ];

    protected $listeners = [
        'delete_leadsource' => 'deleteLeadSource',
        'get_data' => 'getData',
        'new_leadsource' => 'hydrate',
        'reset_form' => 'resetForm'
    ];

    public function render()
    {
        return view('livewire.leadsource.add-leadsource-modal');
    }

    public function createLeadSource()
    {
        $errorMessage = null;
        $this->validate();

        DB::transaction(function () use ($errorMessage) {
            // Prepare the data for creating a new user
            $data = [
                'company_id' => Auth::user()->company_id,
                'source_name' => $this->source_name,
                'created_at' => now(),
                'created_by' => Auth::user()->id,
            ];

            $leadsource = LeadSource::create($data);
            if ($leadsource) {
                // Emit a success event with a message
                $this->dispatch('success', __('New lead source created ' . $errorMessage));
            } else {
                $this->dispatch('error', __('Failed to create new lead source'));
            }

        });
        // Reset the form fields after successful submission
        $this->reset();
    }

    public function updateLeadSource()
    {
        $this->validate();

        DB::transaction(function () {

            $leadsource = LeadSource::findOrFail($this->leadsource_id);
            $leadsource->source_name = $this->source_name;

            if ($leadsource->save()) {
                // Emit a success event with a message
                $this->dispatch('success', __('lead source updated successfully'));
                // Reset the form fields after successful submission
                $this->reset();
            } else {
                $this->dispatch('error', __('Failed to update lead source'));
            }
        });
    }

    public function deleteLeadSource($id)
    {
        $leadsource = LeadSource::findOrFail($id);

        $leadsource->deleted_at = now();
        $leadsource->save();

        // Emit a success event with a message
        $this->dispatch('success', 'Lead Source successfully deleted');
    }

    public function getData($id)
    {
        $this->edit_mode = true;

        $leadsource = LeadSource::find($id);

        $this->leadsource_id = $leadsource->id;
        $this->source_name = $leadsource->source_name;
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
