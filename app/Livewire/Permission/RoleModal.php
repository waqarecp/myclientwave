<?php

namespace App\Livewire\Permission;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleModal extends Component
{
    public $name;
    public $checked_permissions;
    public $check_all;

    public Role $role;
    public Collection $permissions;

    protected $rules = [
        'name' => 'required|string',
    ];

    // This is the list of listeners that this component listens to.
    protected $listeners = ['modal.show.role_name' => 'mountRole'];

    // This function is called when the component receives the `modal.show.role_name` event.
    public function mountRole($role_name = '')
    {
        if (empty($role_name)) {
            // Create new
            $this->role = new Role;
            $this->name = '';
            return;
        }

        // Get the role by name.
        $role = Role::where('name', $role_name)->where("company_id", "=", auth()->user()->company_id)->first();
        if (is_null($role)) {
            $this->dispatch('error', 'The selected role [' . $role_name . '] is not found');
            return;
        }

        $this->role = $role;

        // Set the name and checked permissions properties to the role's values.
        $this->name = $this->role->name;
        $this->checked_permissions = $this->role->permissions->pluck('name');
    }

    // This function is called when the component is mounted.
    public function mount()
    {
        // Get all permissions.
        $this->permissions = Permission::all();

        // Set the checked permissions property to an empty array.
        $this->checked_permissions = [];
    }

    // This function renders the component's view.
    public function render()
    {
        // Create an array of permissions grouped by ability.
        $permissions_by_group = [];
        foreach ($this->permissions ?? [] as $permission) {
            $ability = Str::after($permission->name, ' ');

            $permissions_by_group[$ability][] = $permission;
        }

        // Return the view with the permissions_by_group variable passed in.
        return view('livewire.permission.role-modal', compact('permissions_by_group'));
    }

    // This function submits the form and updates the role's permissions.
    public function submit()
{
    $this->validate();

    // Check if the role with the same name, guard_name, and company_id already exists
    $existingRole = Role::where('name', $this->name)
                        ->where('guard_name', 'web') // assuming you're using the 'web' guard
                        ->where('company_id', auth()->user()->company_id) // Check based on current user's company
                        ->first();

    if ($existingRole && $existingRole->id != $this->role->id) {
        // If a role exists and it's not the current one, return an error
        $this->dispatch('error', 'A role with the name "' . $this->name . '" already exists for this company.');
        return;
    }

    // Proceed with saving the role
    $this->role->name = $this->name;
    $this->role->guard_name = 'web'; // Ensure you're setting the guard_name as well

    // Set the company_id to the logged-in user's company_id
    $this->role->company_id = auth()->user()->company_id;
    // Save the role if it has changed
    if ($this->role->isDirty()) {
        $this->role->save();
    }

    // Sync the role's permissions with the checked permissions property
    $this->role->syncPermissions($this->checked_permissions);

    // Emit a success event with a message indicating that the permissions have been updated
    $this->dispatch('success', 'Permissions for ' . ucwords($this->role->name) . ' role updated');
}

    // This function checks all of the permissions.
    public function checkAll()
    {
        // If the check_all property is true, set the checked permissions property to all of the permissions.
        if ($this->check_all) {
            $this->checked_permissions = $this->permissions->pluck('name');
        } else {
            // Otherwise, set the checked permissions property to an empty array.
            $this->checked_permissions = [];
        }
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
