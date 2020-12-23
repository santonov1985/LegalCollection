<?php
namespace Core\Directories\Notaries;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use core\Tables\Notaries\NotaryTable;

/**
 * Class NotaryTable
 * @package Core\Directories\Notaries
 *
 * @property integer $id
 * @property string $title
 * @property string $email
 * @property string $phone
 * @property string $description
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Notary extends Model
{
    use SoftDeletes;

    public function notaryTable()
    {
        return $this->hasMany(NotaryTable::class);
    }

}
