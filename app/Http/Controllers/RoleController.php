<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Exception;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-role|edit-role|delete-role', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-role', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        try {
            $roles = Role::with('permissions')
                ->orderBy('id', 'DESC')
                ->paginate(5); // Increased from 3 to 5 for better viewing

            return view('roles.index', compact('roles'));
        } catch (Exception $e) {
            return view('roles.index')->with('error', 'Error loading roles: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        try {
            $permissions = Permission::orderBy('name')->get();
            return view('roles.create', compact('permissions'));
        } catch (Exception $e) {
            return back()->with('error', 'Error loading permissions: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $role = Role::create(['name' => $request->name]);

            $permissions = Permission::whereIn('id', $request->permissions)
                ->pluck('name')
                ->toArray();

            $role->syncPermissions($permissions);

            DB::commit();

            return redirect()->route('roles.index')
                ->with('success', 'New role has been created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating role: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(): RedirectResponse
    {
        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View
    {
        try {
            if ($role->name == 'Super Admin') {
                abort(403, 'SUPER ADMIN ROLE CANNOT BE EDITED');
            }

            $permissions = Permission::orderBy('name')->get();
            $rolePermissions = $role->permissions->pluck('id')->toArray();

            return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
        } catch (Exception $e) {
            return back()->with('error', 'Error loading role: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        try {
            if ($role->name == 'Super Admin') {
                abort(403, 'SUPER ADMIN ROLE CANNOT BE MODIFIED');
            }

            DB::beginTransaction();

            $role->update(['name' => $request->name]);

            $permissions = Permission::whereIn('id', $request->permissions)
                ->pluck('name')
                ->toArray();

            $role->syncPermissions($permissions);

            DB::commit();

            return redirect()->route('roles.index')
                ->with('success', 'Role has been updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating role: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        try {
            if ($role->name == 'Super Admin') {
                abort(403, 'SUPER ADMIN ROLE CANNOT BE DELETED');
            }

            if (Auth::user()->hasRole($role->name)) {
                abort(403, 'CANNOT DELETE SELF-ASSIGNED ROLE');
            }

            DB::beginTransaction();

            $role->delete();

            DB::commit();

            return redirect()->route('roles.index')
                ->with('success', 'Role has been deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error deleting role: ' . $e->getMessage());
        }
    }
}
