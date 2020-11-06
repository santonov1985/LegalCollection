<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use Core\ACL\Permissions\Permission;
use Core\ACL\Permissions\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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

    public function resourceStore(Request $request)
    {
        $rules = [
            'name' => 'required|string|unique:permissions,resource',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

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

    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required|string|unique:permissions,name',
            'resource'  => 'required|string|exists:permissions,resource',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

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

    public function update(Request $request, $id)
    {
        $rules = [
            'id'        => 'required|numeric',
            'name'      => 'required|string|unique:permissions,name,' . $id,
            'resource'  => 'required|string|exists:permissions,resource',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

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
