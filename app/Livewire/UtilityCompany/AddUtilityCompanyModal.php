<?php

namespace App\Livewire\UtilityCompany;

use App\Models\UtilityCompany;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddUtilityCompanyModal extends Component
{
    public $utilitycompany_id;
    public $utility_company_name;

    public $edit_mode = false;

    protected $rules = [
        'utility_company_name' => 'required|string'
    ];

    protected $listeners = [
        'delete_utilitycompany' => 'deleteUtilityCompany',
        'get_data' => 'getData',
        'new_utilitycompany' => 'hydrate',
        'reset_form' => 'resetForm'
    ];

    public function render()
    {
        return view('livewire.utilitycompany.add-utilitycompany-modal');
    }

    public function createUtilityCompany()
    {
        $errorMessage = null;
        $this->validate();

        DB::transaction(function () use ($errorMessage) {
            // Prepare the data for creating a new user
            $data = [
                'company_id' => Auth::user()->company_id,
                'utility_company_name' => $this->utility_company_name,
                'created_at' => now(),
                'created_by' => Auth::user()->id,
            ];

            $utilitycompany = UtilityCompany::create($data);
            if ($utilitycompany) {
                // Emit a success event with a message
                $this->dispatch('success', __('New Utility Company created ' . $errorMessage));
            } else {
                $this->dispatch('error', __('Failed to create new Utility Company'));
            }

        });
        // Reset the form fields after successful submission
        $this->reset();
    }

    public function updateUtilityCompany()
    {
        $this->validate();

        DB::transaction(function () {

            $utilitycompany = UtilityCompany::findOrFail($this->utilitycompany_id);
            $utilitycompany->utility_company_name = $this->utility_company_name;

            if ($utilitycompany->save()) {
                // Emit a success event with a message
                $this->dispatch('success', __('utility company updated successfully'));
                // Reset the form fields after successful submission
                $this->reset();
            } else {
                $this->dispatch('error', __('Failed to update utility company'));
            }
        });
    }

    public function deleteUtilityCompany($id)
    {
        $utilitycompany = UtilityCompany::findOrFail($id);

        $utilitycompany->deleted_at = now();
        $utilitycompany->save();

        // Emit a success event with a message
        $this->dispatch('success', 'Utility Company successfully deleted');
    }

    public function getData($id)
    {
        $this->edit_mode = true;

        $utilitycompany = UtilityCompany::find($id);

        $this->utilitycompany_id = $utilitycompany->id;
        $this->utility_company_name = $utilitycompany->utility_company_name;
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
