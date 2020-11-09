<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\Store;
use App\Http\Requests\Permission\Update;
use Core\ACL\Permissions\Permission;
use Core\ACL\Permissions\PermissionRepository;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    protected $repository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->repository = $permissionRepository;
    }

    public function index()
    {
        $permissionsGroups = Permission::all()->groupBy('resource');

        return view('acl.permissions.index', compact('permissionsGroups'));
    }

    public function resourceCreate()
    {
        return view('acl.permissions.resource');
    }

    public function resourceStore(\App\Http\Requests\Resource\Store $request)
    {
        try {

            $this->repository->addNewResource(
                $request->input('name')
            );

            return redirect()->route('permissions');

        } catch (\Throwable $err) {
            Log::error("ACL: add new permissions resource error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors($err->getMessage());
        }
    }

    public function create(string $resource)
    {
        $resource = Permission::query()->where('resource', $resource)->firstOrFail();

        return view('acl.permissions.create', compact('resource'));
    }

    public function store(Store $request)
    {
        try {

            $this->repository->addNewPermission(
                $request->input('resource'),
                $request->input('name')
            );

            return redirect()->route('permissions');

        } catch (\Throwable $err) {
            Log::error("ACL: add new permissions error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors($err->getMessage());
        }
    }

    public function edit(int $id)
    {
        $permission = Permission::query()->findOrFail($id);

        return view('acl.permissions.edit', compact('permission'));
    }

    public function update(Update $request, $id)
    {
        $permission = Permission::query()->findOrFail($id);

        try {

            $this->repository->getUpdatePermission(
                $permission,
                $request->input('name'),
                $request->input('resource')
            );

            return redirect()->route('permissions');

        } catch (\Throwable $err) {
            Log::error("ACL: edit permissions error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors($err->getMessage());
        }
    }

    public function destroy(int $id)
    {
        $permission = Permission::query()->findOrFail($id);
        $permission->delete();

        return redirect()->route('permissions');
    }
}
