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
        return $this->merchantPaymentRoutes->select()->where('merchant_id', $merchantId)->orderBy('priority')->get();
    }

    public function save(MerchantPaymentRoute $merchantPaymentRoute)
    {
         $merchantPaymentRoute->save();
    }

    public function getOne($id)
    {
        return $this->merchantPaymentRoutes->select()->where('id', $id)->first();
    }
    public function delete(MerchantPaymentRoute $route)
    {
        return $route->delete();
    }
}