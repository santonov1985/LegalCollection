<?php

namespace Core\ACL\Roles;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Acl\Models\Role as YajraRole;

/**
 * Class Role
 * @package Core\ACL\Role
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property bool $system
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Role extends YajraRole
{
    use SoftDeletes;

}
