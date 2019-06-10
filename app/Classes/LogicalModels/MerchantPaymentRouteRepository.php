<?php


namespace App\Classes\LogicalModels;


use App\Models\MerchantPaymentRoute;


class MerchantPaymentRouteRepository
{
    public $merchantPaymentRoutes;

    public function __construct(MerchantPaymentRoute $merchantPaymentRoutes)
    {
        $this->merchantPaymentRoutes = $merchantPaymentRoutes;
    }

    public function list($merchantId)
    {
        return $this->merchantPaymentRoutes->select()->where('merchant_id', $merchantId)->get();
    }

    public function save(MerchantPaymentRoute $merchantPaymentRoute)
    {
        $merchantPaymentRoute->save();
    }

}