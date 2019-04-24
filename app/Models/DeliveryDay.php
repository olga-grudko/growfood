<?php
/**
 * Created by PhpStorm.
 * User: olga
 * Date: 24.04.19
 * Time: 17:20
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DeliveryDay
 * @package App\Models
 * @property int tarif_id
 * @property int day
 */
class DeliveryDay extends Model
{
    /**
     * @var string
     */
    protected $table = 'delivery_days';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['tarif_id', 'day'];

    /**
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * @param int $tarifId
     * @return array
     */
    public static function getDeliveryDaysByTarifId(int $tarifId) : array
    {
        return self::query()->select('id', 'day')
            ->where('tarif_id', '=', $tarifId)
            ->get()
            ->toArray();
    }

    public static function getTarifsByDeliveryDay(int $deliveryDay)
    {
        return self::query()->select( 'tarif_id as id', 'tarifs.name')
            ->leftJoin('tarifs', 'tarifs.id', '=', 'delivery_days.tarif_id')
            ->where('delivery_days.day', '=', $deliveryDay)
            ->get()
            ->toArray();
    }
}