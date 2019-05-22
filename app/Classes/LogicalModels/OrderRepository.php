<?php


namespace App\Classes\LogicalModels;


use App\Classes\Helpers\OrderStatusHelper;
use App\Exceptions\NotFoundException;
use App\Models\OrderFieldValues;
use App\Models\Orders;
use App\User;

class OrderRepository
{
    public $order;
    public $orderFieldValues;

    public function __construct(Orders $order, OrderFieldValues $orderFieldValues)
    {
        $this->order = $order;
        $this->orderFieldValues = $orderFieldValues;
    }


    /**
     * Fraud monitoring
     * Security team
     * Business team
     * Please, use only OrderStatusHelper::checkDisplay to check display request or not
     *
     * @return mixed
     */
    public function list()
    {
        $allOrders = $this->order->select()->get();
        $allowedOrders = [];

        foreach ($allOrders as $order) {
            if (OrderStatusHelper::checkDisplay($order->order_status, $order->fraud_check, $order->security_check, $order->business_check)) {
                $allowedOrders[] = $order;
            }
        }

        return $allowedOrders;
    }

    /**
     * @param int $id
     * @return |null
     * @throws NotFoundException
     */
    public function getOne(int $id): Orders
    {
        $order = $this->order->select()->where(['id' => $id])->first();
        if (is_null($order)) {
            throw new NotFoundException('Данный запрос недоступен для просмотра');
        }
        $allowedOrders = null;
        if (OrderStatusHelper::checkDisplay($order->order_status, $order->fraud_check, $order->security_check, $order->business_check)) {
            $allowedOrders = $order;
        }

        return $allowedOrders;
    }

    public function getFieldValues(int $orderId)
    {
        $fieldValues = $this->orderFieldValues->select()->where(['order_id' => $orderId])->get();

        return $fieldValues;
    }

    public function assign(Orders $order, User $user): void
    {
        $order->assigned = $user->id;
        $order->save();
    }
}