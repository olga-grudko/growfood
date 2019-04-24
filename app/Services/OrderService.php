<?php
/**
 * Created by PhpStorm.
 * User: olga
 * Date: 24.04.19
 * Time: 17:17
 */

namespace App\Services;


use App\Helpers\ArrayHelper;
use App\Models\DeliveryDay;
use App\Models\Tarif;
use App\Models\Users;
use App\Models\UserTarif;
use Illuminate\Support\Facades\DB;

class OrderService
{
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;
    const SUNDAY = 7;

    const DAYS_MAP = [
        self::MONDAY => 'Понедельник',
        self::TUESDAY => 'Вторник',
        self::WEDNESDAY => 'Среда',
        self::THURSDAY => 'Четверг',
        self::FRIDAY => 'Пятница',
        self::SATURDAY => 'Суббота',
        self::SUNDAY => 'Воскресение',
    ];

    const SUCCESS_RESPONSE = 'Сохранено';

    /**
     * @return array
     */
    public function getTarifs() : array
    {
        $tarifs = Tarif::getTarifsNames();

        return ArrayHelper::getFormattedArrayForDropdown($tarifs);
    }


    /**
     * @param int $tarifId
     * @return array
     */
    public function getDeliveryDaysByTarifId(int $tarifId) : array
    {
        $deliveryDays = DeliveryDay::getDeliveryDaysByTarifId($tarifId);

        $readableDeliverDayData = $this->getReadableDeliveryDays($deliveryDays);

        return $readableDeliverDayData;
    }

    /**
     * @param int $deliveryDay
     * @return array
     */
    public  function getTarifsByDeliveryDays(int $deliveryDay) : array
    {
        $tarifs = DeliveryDay::getTarifsByDeliveryDay($deliveryDay);

        return ArrayHelper::getFormattedArrayForDropdown($tarifs);
    }

    /**
     * @param array $requestData
     * @return string|void
     */
    public function saveOrder(array $requestData)
    {
        try {
            DB::beginTransaction();

            $userId = Users::create(['name' => $requestData['name'], 'phone' => $requestData['phone']]);
            UserTarif::create(['user_id' => $userId, 'tarif_id' => $requestData['tarif'], 'start_day' => $requestData['delivery_day'] ]);

            DB::commit();

            return self::SUCCESS_RESPONSE;

        } catch(\Exception $e)
        {
            DB::rollBack();

            return $e->getMessage();
        }
    }


    /**
     * @param array $deliveryDays
     * @return array
     */
    private function getReadableDeliveryDays(array $deliveryDays) : array
    {
        $readableDeliverDayData = [];
        foreach($deliveryDays as $oneDay) {
            $readableDeliverDayData[$oneDay['day']] = self::DAYS_MAP[$oneDay['day']];
        }

        return $readableDeliverDayData;
    }
}