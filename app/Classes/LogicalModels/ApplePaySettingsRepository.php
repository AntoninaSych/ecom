<?php


namespace App\Classes\LogicalModels;


use App\Models\ApplePaySettings;

class ApplePaySettingsRepository
{

    public function getByMerchantId(int $id)
    {
        $applePays = new ApplePaySettings();

        return $applePays->select()->where('merchant_id', $id)->get();
    }

    public function save(ApplePaySettings $applePay)
    {
        $applePay->save();
    }

    public function getOne(int $id)
    {
        $applePays = new ApplePaySettings();

        return $applePays->select()->where('id', $id)->first();
    }

    public function remove(ApplePaySettings $applePaySettings)
    {
        $applePaySettings->delete();
    }
}