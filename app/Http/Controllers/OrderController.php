<?php
/**
 * Created by PhpStorm.
 * User: olga
 * Date: 24.04.19
 * Time: 16:12
 */

namespace App\Http\Controllers;


use App\Helpers\ArrayHelper;
use App\Http\Requests\ChangeDeliveryDay;
use App\Http\Requests\ChangeTarifRequest;
use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderController
{
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * OrderController constructor.
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $tarifs = $this->orderService->getTarifs();
        $firstTarifId = ArrayHelper::getFirstKeyFromArray($tarifs);
        $deliveryDays = $this->orderService->getDeliveryDaysByTarifId($firstTarifId);

        return view('order', ['tarifs' => $tarifs, 'deliveryDays' => $deliveryDays]);
    }

    /**
     * @param OrderRequest $orderRequest
     * @return Response
     */
    public function create(OrderRequest $orderRequest): Response
    {
        $response = $this->orderService->saveOrder($orderRequest->except('token'));

        return response($response);
    }

    /**
     * @param ChangeTarifRequest $changeTarifRequest
     * @return Response
     */
    public function changeTarif(ChangeTarifRequest $changeTarifRequest): Response
    {
        if (!$changeTarifRequest->ajax()) {
            return response('Error', Response::HTTP_BAD_REQUEST);
        }

        $tarif = $changeTarifRequest->only('tarif');
        $deliveryDays = $this->orderService->getDeliveryDaysByTarifId($tarif['tarif']);

        return response($deliveryDays);
    }


    /**
     * @param ChangeDeliveryDay $changeDeliveryDay
     * @return Response
     */
    public function changeDeliveryDay(ChangeDeliveryDay $changeDeliveryDay): Response
    {
        if (!$changeDeliveryDay->ajax()) {
            return response('Error', Response::HTTP_BAD_REQUEST);
        }

        $deliveryDay = $changeDeliveryDay->only('delivery_day');

        $tarifsByDay = $this->orderService->getTarifsByDeliveryDays($deliveryDay['delivery_day']);
        $firstTarifId = ArrayHelper::getFirstKeyFromArray($tarifsByDay);
        $tarifs = $this->orderService->getTarifs();

        return response(['tarifs' => $tarifs, 'tarifDay' => $firstTarifId]);
    }


}