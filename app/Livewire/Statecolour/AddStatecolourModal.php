<?php

namespace App\Livewire\Statecolour;

use App\Models\Country;
use App\Models\StateColour;
use App\Models\State;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddStatecolourModal extends Component
{
    public $statecolour_id;
    public $country_id;
    public $state_id;
    public $color_code;
    public $selectedCountryId;
    public $selectedStateId;
    public $states = []; 

    public $edit_mode = false;

    protected $rules = [
        'state_id' => 'required|int',
        'color_code' => 'required|string',

    ];

    protected $listeners = [
        'delete_state_colour' => 'deleteStateColour',
        'get_data' => 'getData',
        'new_statecolour' => 'hydrate',
        'reset_form' => 'resetForm',
    ];

    public function render()
    {
        $countries = Country::active()->pluck('name', 'id');
        $this->states = $this->getStates($this->country_id);
        return view('livewire.statecolour.add-statecolour-modal', ['countries' => $countries, 'states' => $this->states]);
    }

    public function getStates($countryId)
    {
        if ($countryId) {
            return State::where('country_id', $countryId)->pluck('name', 'id')->toArray();
        }
        return [];
    }

    public function createStateColour()
    {
        $errorMessage = null;
        $this->validate();

        DB::transaction(function () use ($errorMessage) {
            // Prepare the data for creating a new user
            $data = [
                'company_id' => Auth::user()->company_id,
                'state_id' => $this->state_id,
                'color_code' => $this->color_code,
                'created_at' => now(),
                'created_by' => Auth::user()->id,
            ];

            $state = StateColour::create($data);
            if ($state) {
                // Emit a success event with a message
                $this->dispatch('success', __('New state color created ' . $errorMessage));
            } else {
                $this->dispatch('error', __('Failed to create new state color'));
            }

        });
        // Reset the form fields after successful submission
        $this->reset();
    }

    public function updateStateColour()
    {
        $this->validate();

        DB::transaction(function () {

            $statecolour = StateColour::findOrFail($this->statecolour_id);
            $statecolour->state_id = $this->state_id;
            $statecolour->color_code = $this->color_code; // Update the color code
            $statecolour->updated_by = Auth::user()->id; 

            if ($statecolour->save()) {
                // Emit a success event with a message
                $this->dispatch('success', __('State color updated successfully'));
                // Reset the form fields after successful submission
                $this->reset();
            } else {
                $this->dispatch('error', __('Failed to update state color'));
            }
        });
    }

    public function deleteStateColour($id)
    {
        $state = StateColour::findOrFail($id);

        $state->deleted_at = now();
        $state->save();

        // Emit a success event with a message
        $this->dispatch('success', 'State successfully deleted');
    }

    public function getData($id)
    {
        $this->edit_mode = true;

        $statecolour = StateColour::with('state')->find($id);

        $this->statecolour_id = $statecolour->id;
        $this->country_id = $statecolour->state->country_id;
        $this->states = $this->getStates($this->country_id);
        $this->state_id = $statecolour->state_id;
        $this->color_code = $statecolour->color_code;
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
