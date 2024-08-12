<?php

namespace App\Livewire\LeadStatus;

use App\Models\LeadStatus;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddLeadStatusModal extends Component
{
    public $leadstatus_id;
    public $status_name;

    public $edit_mode = false;

    protected $rules = [
        'status_name' => 'required|string'
    ];

    protected $listeners = [
        'delete_leadstatus' => 'deleteLeadStatus',
        'get_data' => 'getData',
        'new_leadstatus' => 'hydrate',
        'reset_form' => 'resetForm'
    ];

    public function render()
    {
        return view('livewire.leadstatus.add-leadstatus-modal');
    }

    public function createLeadStatus()
    {
        $errorMessage = null;
        $this->validate();

        DB::transaction(function () use ($errorMessage) {
            // Prepare the data for creating a new user
            $data = [
                'company_id' => Auth::user()->company_id,
                'status_name' => $this->status_name,
                'created_at' => now(),
                'created_by' => Auth::user()->id,
            ];

            $leadstatus = LeadStatus::create($data);
            if ($leadstatus) {
                // Emit a success event with a message
                $this->dispatch('success', __('New Lead Status created ' . $errorMessage));
            } else {
                $this->dispatch('error', __('Failed to create new Lead Status'));
            }

        });
        // Reset the form fields after successful submission
        $this->reset();
    }

    public function updateLeadStatus()
    {
        $this->validate();

        DB::transaction(function () {

            $leadstatus = LeadStatus::findOrFail($this->leadstatus_id);
            $leadstatus->status_name = $this->status_name;

            if ($leadstatus->save()) {
                // Emit a success event with a message
                $this->dispatch('success', __('Lead Status updated successfully'));
                // Reset the form fields after successful submission
                $this->reset();
            } else {
                $this->dispatch('error', __('Failed to update Lead Status'));
            }
        });
    }

    public function deleteLeadStatus($id)
    {
        $leadstatus = LeadStatus::findOrFail($id);

        $leadstatus->deleted_at = now();
        $leadstatus->save();

        // Emit a success event with a message
        $this->dispatch('success', 'Lead Status successfully deleted');
    }

    public function getData($id)
    {
        $this->edit_mode = true;

        $leadstatus = LeadStatus::find($id);

        $this->leadstatus_id = $leadstatus->id;
        $this->status_name = $leadstatus->status_name;
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
