<?php


namespace App\Classes\Helpers;

use App\Models\Orders;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
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
    public static function checkByMyDepart(Orders $order): bool
    {


        [$orderStatus, $fraudCheck, $securityCheck, $businessCheck] =
            [$order->order_status, $order->fraud_check, $order->security_check, $order->business_check];


        if (!is_null($order->decline_user_id)) {
            return false;
        }


        if (auth()->user()->hasRole(RoleHelper::DEVELOPER)) {
            return true;
        }


        if ($orderStatus === OrderStatusHelper::STATUS_NEW) {
            if (auth()->user()->hasRole(RoleHelper::FRAUD_MONITORING)) {

                if (is_null($fraudCheck)) {
                    return true;

                }
                return false;
            }

            if (auth()->user()->hasRole(RoleHelper::SECURITY)) {

                if (!is_null($fraudCheck) && is_null($securityCheck)) {
                    return true;

                }
                return false;
            }

            if (auth()->user()->hasRole(RoleHelper::BUSINESS)) {

                if (!is_null($fraudCheck) && !is_null($securityCheck) && is_null($businessCheck)) {
                    return true;
                }
                return false;

            }
        }

        return false;
    }

    public static function checkByOwner(Orders $order)
    {
        if (!is_null($order->assigned) && Auth::user()->getAuthIdentifier() !== $order->assigned) {
            return false;
        }
        return self::checkByMyDepart($order);
    }

    public static function getAllowedDeparts()
    {
        return [
            RoleHelper::SECURITY => 'Отдел Безопасности',
            RoleHelper::FRAUD_MONITORING => 'Отдел Фрода',
            RoleHelper::BUSINESS => 'Отдел Бизнеса'
        ];
    }

    public static function searchByDepart(Orders $order, $depart)
    {
        [ $orderStatus, $fraudCheck, $securityCheck, $businessCheck] =
            [$order->order_status,   $order->fraud_check, $order->security_check, $order->business_check];



        if ($orderStatus === OrderStatusHelper::STATUS_NEW) {
            if ($depart == RoleHelper::FRAUD_MONITORING) {
                if (is_null($fraudCheck)) {
                    return true;
                }
                return false;
            }
            if ($depart == RoleHelper::SECURITY) {
                if (!is_null($fraudCheck) && is_null($securityCheck)) {
                    return true;
                }
                return false;
            }


            if ($depart == RoleHelper::BUSINESS) {
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

