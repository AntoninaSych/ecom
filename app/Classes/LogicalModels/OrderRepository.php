<?php


namespace App\Classes\LogicalModels;


use App\Classes\Helpers\RoleHelper;
use App\Models\Orders;

class OrderRepository
{
    public $order;

    public function __construct(Orders $order)
    {
        $this->order = $order;
    }


    /**
     *
     *
     * Fraud monitoring
     * Security team
     * Business team
     *
     *
     * @return mixed
     */
    public function list()
    {

        $allRequests = $this->order->select()->get();
        dd($allRequests);
        //   auth()->user()->hasRole([RoleHelper::SECURITY,RoleHelper::BUSINESS,RoleHelper::FRAUD_MONITORING]);
        if (auth()->user()->hasRole(RoleHelper::FRAUD_MONITORING)) {


//            $allRequests = array_map(function ($request) {
//                if ($request->order_status === 'new') {
//                    if ($request->fraud_check === 0) {
//                        return $request;
//                    }
//                }
//            }, $allRequests);



        }


        return $allRequests;

    }
}