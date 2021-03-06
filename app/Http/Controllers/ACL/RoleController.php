<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\Store;
use Core\ACL\Permissions\Permission;
use Core\ACL\Roles\RoleRepository;
use Illuminate\Http\Request;
use Core\ACL\Roles\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    protected $repository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->repository = $roleRepository;
    }

    public function index()
    {
        $roles = Role::withTrashed()->orderBy('id')->get();

        return view('acl.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissionsGroups = Permission::all()->groupBy('resource');

        return view('acl.roles.create', compact('permissionsGroups'));
    }

    public function store(Store $request)
    {
        try {

            $slug  = Str::slug($request->input('name'), '_');

            $this->repository->addNewRole(
                $request->input('name'),
                $slug,
                $request->input('description'),
                $request->input('permissions')
            );

            return redirect()->route('roles');

        } catch (\Throwable $err) {
            Log::error("ACL: add new role error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors($err->getMessage());
        }
    }

    public function edit(int $id)
    {
        $role               = Role::query()->findOrFail($id);
        $permissionsGroups  = Permission::all()->groupBy('resource');

        return view('acl.roles.edit', compact('role', 'permissionsGroups'));
    }

    public function update(Request $request, int $id)
    {
        $role = Role::query()->findOrFail($id);

        try {

            $slug  = Str::slug($request->input('name'), '_');

            $this->repository->getUpdateRole(
                $role,
                $request->input('name'),
                $slug,
                $request->input('description'),
                $request->input('permissions')
            );

            return redirect()->route('roles');

        } catch (\Throwable $err) {
            Log::error("ACL: edit role error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors($err->getMessage());
        }
    }

    public function destroy(int $id)
    {
        $role = Role::query()->findOrFail($id);
        $role->delete();

        return redirect()->back();
    }

    public function restore(int $id)
    {
        $role = Role::withTrashed()->findOrFail($id);
        $role->restore();

        return redirect()->back();
    }
}
