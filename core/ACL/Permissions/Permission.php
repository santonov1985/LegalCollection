<?php

namespace Core\ACL\Permissions;

use Carbon\Carbon;
use Yajra\Acl\Models\Permission as YajraPermission;

/**
 * Class Permission
 * @package Core\ACL\Role
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $resource
 * @property bool $system
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Permission extends YajraPermission
{

}
