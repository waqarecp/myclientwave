<?php

namespace App\Policies;

use App\Models\InventorySetupConfig;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InventorySetupConfigPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, InventorySetupConfig $inventorySetupConfig): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, InventorySetupConfig $inventorySetupConfig): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InventorySetupConfig $inventorySetupConfig): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, InventorySetupConfig $inventorySetupConfig): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, InventorySetupConfig $inventorySetupConfig): bool
    {
        //
    }
}
