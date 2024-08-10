<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AddUserModal extends Component
{
    use WithFileUploads;

    public $user_id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $avatar;
    public $saved_avatar;

    public $edit_mode = false;

    protected $listeners = [
        'delete_user' => 'deleteUser',
        'update_user' => 'updateUser',
        'new_user' => 'hydrate',
        'reset_form' => 'resetForm'
    ];

    public function render()
    {
        $roles = Role::all();

        return view('livewire.user.add-user-modal', compact('roles'));
    }

    public function createAccount()
    {
        // Define validation rules
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:4',
            'role' => 'required|string',
            'avatar' => 'nullable|sometimes|image|max:1024',
        ];

        // Validate the form input data
        $validatedData = $this->validate($rules);

        DB::transaction(function () use ($validatedData) {
            // Prepare the data for creating a new user
            $data = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'email_verified_at' => now(),
                'profile_photo_path' => $this->avatar ? $this->avatar->store('avatars', 'public') : null
            ];

            // Create the user
            $user = User::create($data);

            if ($user) {
                // Assign the selected role to the user
                $user->assignRole($validatedData['role']);

                // Emit a success event with a message
                $this->dispatch('success', __('New user created'));
            } else {
                $this->dispatch('error', __('Failed to create new user'));
            }

            $this->reset();
        });
    }

    public function updateAccount()
    {
        // Define validation rules
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:4',
            'role' => 'required|string',
            'avatar' => 'nullable|sometimes|image|max:1024',
        ];

        // Validate the form input data
        $validatedData = $this->validate($rules);

        DB::transaction(function () use ($validatedData) {

            $user = User::findOrFail($this->user_id);
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            // Update password if it's provided
            if ($validatedData['password']) {
                $user->password = Hash::make($validatedData['password']);
            }

            if ($this->avatar) {
                // Delete the existing avatar if it exists
                if ($user->profile_photo_path) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }
                $user->profile_photo_path = $this->avatar->store('avatars', 'public');
            }

            $user->updated_at = now();
            $user->user_modified = Auth::user()->id;
            $user->save();
            // Assign selected role for user
            $user->syncRoles($validatedData['role']);

            $this->dispatch('success', __('User account updated successfully'));
        });

        $this->reset();
    }

    public function deleteUser($id)
    {
        // Prevent deletion of current user
        if ($id == Auth::id()) {
            $this->dispatch('error', 'Personal account cannot be deleted');
            return;
        }

        // Find the user by ID
        $user = User::findOrFail($id);

        // Soft delete the user
        $user->deleted_at = now();
        $user->deletedBy = $user->user_modified = Auth::user()->id;
        $user->save();

        // Emit a success event with a message
        $this->dispatch('success', 'User successfully deleted');
    }

    public function updateUser($id)
    {
        $this->edit_mode = true;

        $user = User::find($id);

        $this->user_id = $user->id;
        $this->saved_avatar = $user->profile_photo_url;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles?->first()->name ?? '';
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