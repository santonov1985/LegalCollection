<?php

namespace Core\ACL\Roles;

class RoleRepository
{
    /**
     * Add new role
     *
     * @param string $name
     * @param string $slug
     * @param string|null $description
     * @param array|null $permissions
     * @param bool $system
     * @return Role
     * @throws \Throwable
     */
    public function addNewRole(
        string $name,
        string $slug,
        string $description = null,
        array $permissions = null,
        bool $system = false
    ): Role
    {
        $role = new Role;
        $role->name = $name;
        $role->slug = $slug;
        $role->description = $description;
        $role->system = $system;
        $role->saveOrFail();

        if ($permissions !== null) {
            foreach ($permissions as $permission) {
                $role->assignPermission($permission);
            }
        }

        return $role;
    }

    /**
     * Edit role data
     *
     * @param Role $role
     * @param string $name
     * @param string $slug
     * @param array $permissions
     * @param string $description
     * @param bool $system
     * @return Role
     * @throws \Throwable
     */
    public function getUpdateRole(
        Role $role,
        string $name,
        string $slug,
        string $description = null,
        array $permissions = null,
        bool $system = false
    ): Role
    {
        $role->name = $name;
        $role->slug = $slug;
        $role->description = $description;
        $role->system = $system;

        if ($permissions !== null) {

            $role->revokeAllPermissions();

            foreach ($permissions as $permission) {
                $role->assignPermission($permission);
            }
        }

        $role->saveOrFail();

        return $role;
    }

}
