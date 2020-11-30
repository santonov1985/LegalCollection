<?php

namespace Core\Tables\PrivateBailiff;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

///**
// * Class PrivateBailiff
// * @package Core\Directories\PrivateBailiff
// *
// * @property integer $id
// * @property string $title
// * @property string $email
// * @property string $phone
// * @property string $description
// * @property Carbon $deleted_at
// * @property Carbon $created_at
// * @property Carbon $updated_at
// */

class PrivateBailiff extends Model
{
    use SoftDeletes;
}
