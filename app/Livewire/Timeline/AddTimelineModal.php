<?php

namespace App\Livewire\Timeline;

use App\Models\Timeline;
use App\Models\User;
use App\Models\Lead;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddTimelineModal extends Component
{
    public $timeline_id;
    public $lead_id;
    public $timeline_date;

    public $edit_mode = false;

    protected $rules = [
        'lead_id' => 'integer|required',
        'timeline_date' => 'required|date',
    ];

    protected $listeners = [
        'delete_timeline' => 'deletetimeline',
        'get_data' => 'getData',
        'new_timeline' => 'hydrate',
        'reset_form' => 'resetForm'
    ];

    public function render()
    {
        $users = User::where('deleted_at', null)->get();
        $leads = Lead::where('deleted_at', null)->get();
        return view('livewire.timeline.add-timeline-modal', compact('users', 'leads'));
    }

    public function createTimeline()
    {
        $errorMessage = null;
        $this->validate();

        DB::transaction(function () use ($errorMessage) {
            // Prepare the data for creating a new user
            $data = [
                'lead_id' => $this->lead_id,
                'company_id' => Auth::user()->company_id,
                'timeline_date' => $this->timeline_date,
                'created_by' => Auth::user()->id,
            ];

            $timeline = Timeline::create($data);
            if ($timeline) {
                // Emit a success event with a message
                $this->dispatch('success', __('New timeline created ' . $errorMessage));
            } else {
                $this->dispatch('error', __('Failed to create new timeline'));
            }

        });
        // Reset the form fields after successful submission
        $this->reset();
    }

    public function updateTimeline()
    {
        $this->validate();

        DB::transaction(function () {

            $timeline = Timeline::findOrFail($this->timeline_id);
            $timeline->lead_id = $this->lead_id;
            $timeline->timeline_date = $this->timeline_date;

            if ($timeline->save()) {
                // Emit a success event with a message
                $this->dispatch('success', __('timeline updated successfully'));
                // Reset the form fields after successful submission
                $this->reset();
            } else {
                $this->dispatch('error', __('Failed to update timeline'));
            }
        });
    }

    public function deleteTimeline($id)
    {
        $timeline = Timeline::findOrFail($id);

        $timeline->deleted_at = now();
        $timeline->save();

        // Emit a success event with a message
        $this->dispatch('success', 'timeline successfully deleted');
    }

    public function getData($id)
    {
        $this->edit_mode = true;

        $timeline = Timeline::find($id);

        $this->timeline_id = $timeline->id;
        $this->lead_id = $timeline->lead_id;
        $this->timeline_date = $timeline->timeline_date;
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
