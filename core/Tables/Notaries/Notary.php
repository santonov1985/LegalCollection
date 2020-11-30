<?php
namespace Core\Tables\Notaries;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Notary
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
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Notary extends Model
{
    protected $table = 'notaries_table';

    use SoftDeletes;


}
