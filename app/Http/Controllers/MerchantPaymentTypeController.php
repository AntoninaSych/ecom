<?php


namespace App\Http\Controllers;


use App\Classes\LogicalModels\MerchantPaymentTypeRepository;

class MerchantPaymentTypeController
{
    public $merchantPaymentTypes;

    public function __construct(MerchantPaymentTypeRepository $merchantPaymentTypes)
    {
        $this->merchantPaymentTypes = $merchantPaymentTypes;
    }

    public function index()
    {
       return $this->merchantPaymentTypes->list();
    }
}