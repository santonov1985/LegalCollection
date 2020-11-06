<?php

namespace Core\Users;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Yajra\Acl\Traits\HasRole;

/**
 * Class User
 * @package Core\Users\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $photo
 * @property string $password
 * @property Carbon deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'photo', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function userIsOnline()
    {
        return Cache::has('user-online-' . $this->id);
    }
}
