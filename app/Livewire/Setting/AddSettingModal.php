<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use App\Models\Dealer;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddSettingModal extends Component
{
    public $setting_id;
    public $platform_name;
    public $api_key;
    public $username;
    public $password;
    public $api_url;
    public $status = 1;
    public $dealer_id = 0;

    public $edit_mode = false;

    protected $listeners = [
        'delete_setting' => 'deleteSetting',
        'get_data' => 'getData',
        'new_setting' => 'hydrate',
        'reset_form' => 'resetForm'
    ];

    #[On('setDealerId')]
    public function setDealerId($selectedDealerId = null): void
    {
        $this->dealer_id = $selectedDealerId;
    }

    public function render()
    {
        $dealers = Dealer::whereNull('deleted_at')->get();

        return view('livewire.setting.add-setting-modal', compact('dealers'));
    }

    public function createSetting()
    {
        $rules = [
            'dealer_id' => 'required|integer',
            'platform_name' => 'required|string',
            'api_key' => 'nullable|string|required_without:username',
            'username' => 'nullable|string|required_without:api_key',
            'password' => 'nullable|string|required_with:username'
        ];
    
        $customMessages = [
            'dealer_id.required' => 'Dealer Account ID field is required.',
            'api_key.required_without' => 'The API key is required when username is not provided.',
            'username.required_without' => 'The username is required when API key is not provided.',
            'password.required_with' => 'The password is required when the username is present.'
        ];

        $validatedData = $this->validate($rules, $customMessages);

        DB::transaction(function () use ($validatedData) {
            $data = [
                'dealer_id' => $this->dealer_id,
                'platform_name' => $validatedData['platform_name'],
                'api_key' => $validatedData['api_key'] ?? null,
                'api_url' => $this->api_url ?? null,
                'username' => $validatedData['username'] ?? null,
                'password' => $validatedData['password'] ?? null,
                'status' => isset($this->status) ? $this->status : 1,
                'user_id' => Auth::user()->id
            ];

            $setting = Setting::create($data);

            if ($setting) {
                $this->dispatch('success', __('New settings created'));
            } else {
                $this->dispatch('error', __('Failed to create new settings'));
            }

            $this->reset();
        });
    }

    public function updateSetting()
    {
        $rules = [
            'dealer_id' => 'required|integer',
            'platform_name' => 'required|string',
            'api_key' => 'nullable|string|required_without:username',
            'username' => 'nullable|string|required_without:api_key',
            'password' => 'nullable|string|required_with:username'
        ];
    
        $customMessages = [
            'dealer_id.required' => 'Dealer Account ID field is required.',
            'api_key.required_without' => 'The API key is required when username is not provided.',
            'username.required_without' => 'The username is required when API key is not provided.',
            'password.required_with' => 'The password is required when the username is present.'
        ];

        $validatedData = $this->validate($rules, $customMessages);

        DB::transaction(function () use ($validatedData) {
            $setting = Setting::findOrFail($this->setting_id);

            $setting->dealer_id = $this->dealer_id;
            $setting->platform_name = $validatedData['platform_name'];
            $setting->api_key = $validatedData['api_key'] ?? null;
            $setting->api_url = $this->api_url;
            $setting->username = $validatedData['username'] ?? null;
            $setting->password = $validatedData['password'] ?? null;
            $setting->status = isset($this->status) ? $this->status : 1;
            $setting->user_modified = Auth::user()->id;
            $setting->updated_at = now();
            
            $setting->save();

            $this->dispatch('success', __('Settings updated successfully'));
        });

        $this->reset();
    }

    public function deleteSetting($id)
    {
        $setting = Setting::findOrFail($id);

        $setting->deleted_at = now();
        $setting->deleted_by = Auth::user()->id;
        $setting->save();

        $this->dispatch('success', 'Settings successfully deleted');
    }

    public function getData($id)
    {
        $this->edit_mode = true;

        $setting = Setting::findOrFail($id);

        $this->fill([
            'setting_id' => $setting->id,
            'platform_name' => $setting->platform_name,
            'api_key' => $setting->api_key,
            'username' => $setting->username,
            'password' => $setting->password,
            'api_url' => $setting->api_url,
            'status' => $setting->status,
            'dealer_id' => $setting->dealer_id,
        ]);
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
