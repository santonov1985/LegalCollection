<?php

namespace Core\ACL\Permissions;

use Illuminate\Database\Eloquent\Collection;

class PermissionRepository
{
    /**
     * Add new resource
     *
     * @param string $resource
     * @param bool $system
     * @return \Illuminate\Support\Collection
     */
    public function addNewResource(
        string $resource,
        bool $system = false
    ): Collection
    {
        return Permission::createResource($resource, $system);
    }

    /**
     * Add new permissions
     *
     * @param string $resource
     * @param string $newPermission
     * @param bool $system
     * @return Permission
     * @throws \Throwable
     */
    public function addNewPermission(
        string $resource,
        string $newPermission,
        bool $system = false
    ): Permission
    {
        $name   = ucfirst($newPermission) . ' ' . $resource;
        $slug   = strtolower($resource) . '.' . strtolower($newPermission);

        $permission             = new Permission;
        $permission->name       = $name;
        $permission->slug       = $slug;
        $permission->resource   = $resource;
        $permission->system     = $system;
        $permission->saveOrFail();

        return  $permission;
    }

    /**
     * Get update permissions
     *
     * @param Permission $permission
     * @param string $name
     * @param string $resource
     * @param bool $system
     * @return Permission
     * @throws \Throwable
     */
    public function getUpdatePermission(
        Permission $permission,
        string $name,
        string $resource,
        bool $system = false
    ): Permission
    {
        $name   = ucfirst($name) . ' ' . $resource;
        $slug   = strtolower($resource) . '.' . strtolower($name);

        $permission->name       = $name;
        $permission->slug       = $slug;
        $permission->resource   = $resource;
        $permission->system     = $system;
        $permission->saveOrFail();

        return  $permission;
    }

    /**
     * Delete permissions
     *
     * @param Permission $permission
     * @return bool|null
     * @throws \Exception
     */
    public function getDeletePermission(Permission $permission): ?bool
    {
        if ($permission->system === true) {
            return false;
        }

        return $permission->delete();
    }
}
