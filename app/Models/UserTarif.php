<?php
/**
 * Created by PhpStorm.
 * User: olga
 * Date: 24.04.19
 * Time: 17:26
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserTarif
 * @package App\Models
 * @property int user_id
 * @property int tarif_id
 * @property int start_day
 */
class UserTarif extends Model
{
    /**
     * @var string
     */
    protected $table = 'users_tarifs';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'tarif_id', 'start_day'];

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @param array $attributes
     * @return bool
     */
    public static function create(array $attributes) : bool
    {
        $tarif = new self();
        $tarif->fill($attributes);
        return $tarif->save();
    }
}