<?php

use Core\ACL\Permissions\Permission;
use Core\ACL\Roles\Role;
use Core\Users\User;

return [
    /**
     * User class used for ACL.
     */
    'user'       => User::class,

    /**
     * Role class used for ACL.
     */
    'role'       => Role::class,

    /**
     * Permission class used for ACL.
     */
    'permissions' => Permission::class,

    /**
     * Cache config.
     */
    'cache'      => [
        'enabled' => true,

        'key' => 'permissions.policies',
    ],
];
