<?php
namespace Core\Settings\Notary;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DefaultSetting
 * @package Core\Settings\NotaryTable
 *
 * @property float $notary_cost
 */

class DefaultSetting extends Model
{
    protected $table = 'default_settings';
}
