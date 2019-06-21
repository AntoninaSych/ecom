<?php


namespace App\Classes\LogicalModels;


use App\Classes\Filters\CardFilter;
use App\Classes\Filters\SearchMerchantRequestsFilter;
use App\Classes\Helpers\OrderStatusHelper;
use App\Exceptions\NotFoundException;
use App\Models\OrderFieldValues;
use App\Models\Orders;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public $order;
    public $orderFieldValues;
    public $user;

    public function __construct(Orders $order, OrderFieldValues $orderFieldValues, User $user)
    {
        $this->order = $order;
        $this->orderFieldValues = $orderFieldValues;
        $this->user = $user;
    }


    public function list(SearchMerchantRequestsFilter $filter)
    {

        $results = $this->order->select()->get();

        $allowedOrders = new Collection();


        if (isset($filter->department)) {
            foreach ($results as $order) {
                if (OrderStatusHelper::searchByDepart($order, $filter->department)) {
                    $allowedOrders->push($order);
                }
            }
        }

        else {
            foreach ($results as $order) {
                if (OrderStatusHelper::checkByMyDepart($order)) {
                    $allowedOrders->push($order);
                }
            }
        }


        return $allowedOrders;
    }

    public function archive()
    {
        $results = $this->order->select()->get();

        return $results;
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

        return $order;
    }

    /**
     * @param int $orderId
     * @return mixed
     */
    public function getFieldValues(int $orderId)
    {
        $fieldValues = $this->orderFieldValues->select()->where(['order_id' => $orderId])->get();

        return $fieldValues;
    }

    /**
     * @param Orders $order
     * @param User $user
     */
    public function assign(Orders $order, User $user): void
    {
        $order->assigned = $user->id;
        $order->save();
    }
}