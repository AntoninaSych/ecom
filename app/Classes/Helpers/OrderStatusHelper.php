<?php


namespace App\Classes\Helpers;

use App\Models\Orders;
use Illuminate\Support\Facades\Facade;

class OrderStatusHelper extends Facade
{
    const STATUS_BLOCKED = 4;
    const STATUS_ACTIVATE = 3;
    const STATUS_NEW = 1;
    const STATUS_TESTED = 2;

    /**
     * @param $orderStatus
     * @param $fraudCheck
     * @param $securityCheck
     * @param $businessCheck
     * @return bool
     */
    public static function checkDisplay(Orders $order): bool
    {

         [$orderStatus, $fraudCheck, $securityCheck, $businessCheck] =
           [$order->order_status, $order->fraud_check, $order->security_check, $order->business_check];


        if (!is_null($order->decline_user_id)) {
            return false;
        }


        if (auth()->user()->hasRole(RoleHelper::DEVELOPER)) {
            return true;
        }

        if (auth()->user()->hasRole(RoleHelper::FRAUD_MONITORING)) {
            if ($orderStatus === OrderStatusHelper::STATUS_NEW) {
                if (is_null($fraudCheck)) {
                    return true;
                }
                return false;
            }
            return false;
        }


        if (auth()->user()->hasRole(RoleHelper::SECURITY)) {
            if ($orderStatus === OrderStatusHelper::STATUS_NEW) {
                if (!is_null($fraudCheck) && is_null($securityCheck)) {
                    return true;
                }
                return false;
            }
            return false;
        }

        if (auth()->user()->hasRole(RoleHelper::BUSINESS)) {
            if ($orderStatus === OrderStatusHelper::STATUS_NEW) {
                if (!is_null($fraudCheck) && !is_null($securityCheck) && is_null($businessCheck)) {
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }
}

