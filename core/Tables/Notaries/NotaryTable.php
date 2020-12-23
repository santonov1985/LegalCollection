<?php
namespace Core\Tables\Notaries;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use core\Directories\Notaries\Notary;

/**
 * Class NotaryTable
 * @package Core\Tables\Notaries
 *
 * @property integer $id
 * @property integer $number_loan
 * @property string $iin
 * @property string $identification
 * @property string $full_name
 * @property string $email
 * @property string $home_phone
 * @property string $mobile_phone
 * @property integer $notary_id
 * @property string $work_phone
 * @property string $residence_address
 * @property string $place_of_residence
 * @property string $date_of_issue
 * @property integer $loan_term
 * @property integer $issued_amount
 * @property integer $delayed_od
 * @property integer $delayed_prc
 * @property integer $delayed_fines
 * @property integer $total
 * @property integer $notary_cost
 * @property integer $total_with_notary_cost
 * @property integer $number_of_day_overdue
 * @property string $transferDate
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class NotaryTable extends Model
{
    protected $table = 'notaries_table';

    use SoftDeletes;

    public function notary()
    {
        return $this->hasOne(Notary::class);
    }

    public function scopeSearch($query, string $string = null)
    {
        if ($string !== null) {
            return $query->where('number_loan', 'LIKE', $string)
                ->orWhere('iin', 'LIKE', $string)
                ->orWhere('identification', 'LIKE', $string)
                ->orWhere('full_name', 'LIKE', '%' .$string. '%')
                ->orWhere('number_of_day_overdue', 'like', $string);
        }
        return null;
    }

    public function scopeNotary($query, Notary $notary = null)
    {
        if ($notary !== null) {
            return $query->where('notary_id', $notary->id);
        }
        return null;
    }

    public function scopeDate($query, string $date = null)
    {
        if ($date !== null) {
            return $query->where('transfer_date', $date);
        }
        return null;
    }

}
