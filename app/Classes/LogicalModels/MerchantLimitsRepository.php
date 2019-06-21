<?php


namespace App\Classes\LogicalModels;


use App\Models\MerchantPaymentLimits;
use App\Models\RefLimitType;

class MerchantLimitsRepository
{

    public function getList(int $merchantId)
    {
        $limits = new MerchantPaymentLimits();
        $limits = $limits->select()->where('merchant_id', $merchantId)->get();

        return $limits;
    }

    public function getLimitTypes()
    {
        return RefLimitType::all()->pluck('name', 'id');
    }

    public function getOne(int $merchantLimitId)
    {
        $limit = new MerchantPaymentLimits();
        $limit = $limit->select()->where('id', $merchantLimitId)->first();


        return $limit;
    }

    public function save(MerchantPaymentLimits $merchantPaymentLimit)
    {
        $merchantPaymentLimit->save();
    }


}