<?php

namespace App\Livewire\Status;

use App\Models\Status;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddStatusModal extends Component
{
    public $status_id;
    public $status_name;
    public $color_code; // Add this property


    public $edit_mode = false;

    protected $rules = [
        'status_name' => 'required|string',
        'color_code' => 'required|string' // Add validation for color code

    ];

    protected $listeners = [
        'delete_status' => 'deleteStatus',
        'get_data' => 'getData',
        'new_status' => 'hydrate',
        'reset_form' => 'resetForm',
    ];

    public function render()
    {
        return view('livewire.status.add-status-modal');
    }

    public function createStatus()
    {
        $errorMessage = null;
        $this->validate();

        DB::transaction(function () use ($errorMessage) {
            // Prepare the data for creating a new user
            $data = [
                'company_id' => Auth::user()->company_id,
                'status_name' => $this->status_name,
                'color_code' => $this->color_code,
                'created_at' => now(),
                'created_by' => Auth::user()->id,
            ];

            $status = Status::create($data);
            if ($status) {
                // Emit a success event with a message
                $this->dispatch('success', __('New Status created ' . $errorMessage));
            } else {
                $this->dispatch('error', __('Failed to create new Status'));
            }

        });
        // Reset the form fields after successful submission
        $this->reset();
    }

    public function updateStatus()
    {
        $this->validate();

        DB::transaction(function () {

            $status = Status::findOrFail($this->status_id);
            $status->status_name = $this->status_name;
            $status->color_code = $this->color_code; // Update the color code

            if ($status->save()) {
                // Emit a success event with a message
                $this->dispatch('success', __('Status updated successfully'));
                // Reset the form fields after successful submission
                $this->reset();
            } else {
                $this->dispatch('error', __('Failed to update Status'));
            }
        });
    }

    public function deleteStatus($id)
    {
        $status = Status::findOrFail($id);

        $status->deleted_at = now();
        $status->save();

        // Emit a success event with a message
        $this->dispatch('success', 'Status successfully deleted');
    }

    public function getData($id)
    {
        $this->edit_mode = true;

        $status = Status::find($id);

        $this->status_id = $status->id;
        $this->status_name = $status->status_name;
        $this->color_code = $status->color_code; // Load the color code
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
