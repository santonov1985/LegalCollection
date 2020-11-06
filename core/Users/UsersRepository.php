<?php

namespace Core\Users;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Core\ACL\Roles\Role;

class UsersRepository
{
    /**
     * Create new user
     *
     * @param Collection $roles
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $filenamePath
     * @return User
     * @throws \Throwable
     */
    public function getCreate(
        Collection $roles,
        string $name,
        string $email,
        string $password
    ): User
    {
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->saveOrFail();

        if ($roles->isNotEmpty()) {
            $user->revokeAllRoles();

            foreach ($roles as $role) {
                $user->assignRole($role->id);
            }
        }

        return $user;
    }

    /**
     * Update user
     *
     * @param User $user
     * @param Collection $roles
     * @param string $name
     * @param string $email
     * @param string|null $password
     * @return User
     * @throws \Throwable
     */
    public function getUpdate(
        User $user,
        Collection $roles,
        string $name,
        string $email,
        string $password = null
    ): User
    {
        $user->name = $name;
        $user->email = $email;

        if ($password !== null) {
            $user->password = Hash::make($password);
        }

        $user->saveOrFail();

        if ($roles->isNotEmpty()) {
            $user->revokeAllRoles();

            foreach ($roles as $role) {
                $user->assignRole($role->id);
            }
        }

        return $user;
    }

    /**
     * Update account
     *
     * @param User $user
     * @param string $name
     * @param string $email
     * @param string $filenamePath
     * @param string|null $password
     * @return User
     * @throws \Throwable
     */
    public function getUpdateAccount(
        User $user,
        string $name,
        string $email,
        string $password = null,
        string $filenamePath = null

    ) {
        $user->name = $name;
        $user->email = $email;
        $user->photo = $filenamePath;


        if ($password !== null) {
            $user->password = Hash::make($password);
        }

        $user->saveOrFail();

        return $user;
    }
}
