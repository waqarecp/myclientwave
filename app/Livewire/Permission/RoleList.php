<?php

namespace App\Livewire\Permission;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleList extends Component
{
    public array|Collection $roles;

    protected $listeners = ['success' => 'updateRoleList'];

    public function render()
    {
        $this->roles = Role::with('permissions')->where("company_id", "=", auth()->user()->company_id)->get();

        return view('livewire.permission.role-list');
    }

    public function updateRoleList()
    {
        $this->roles = Role::with('permissions')->get();
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
