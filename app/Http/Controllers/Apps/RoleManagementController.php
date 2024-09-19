<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\UsersAssignedRoleDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages/apps.user-management.roles.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role, UsersAssignedRoleDataTable $dataTable)
    {
        // Get the logged-in user's company_id
        $userCompanyId = auth()->user()->company_id;

        // Check if the role belongs to the same company
        if ($role->company_id !== $userCompanyId) {
            // Redirect the user to the roles page if they don't have access
            return redirect('user-management/roles')->with('error', 'Hey ' . ucwords(auth()->user()->name) . '! You do not have access to this role. Thank you');
        }

        return $dataTable->with('role', $role)
            ->render('pages/apps.user-management.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
