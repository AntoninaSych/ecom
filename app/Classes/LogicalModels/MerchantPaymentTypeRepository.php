<?php


namespace App\Classes\LogicalModels;


use App\Models\MerchantPaymentTypes;


class MerchantPaymentTypeRepository
{
    public $merchantPaymentTypes;

    public function __construct(MerchantPaymentTypes $merchantPaymentTypes)
    {
        $this->merchantPaymentTypes = $merchantPaymentTypes;
    }

    public function list()
    {
        return $this->merchantPaymentTypes->select()->get();
    }

}