<?php


namespace App\Classes\LogicalModels;


use App\Models\PaymentType;

class PaymentTypesRepository
{
    protected $paymentTypes;

    public function __construct(PaymentType $paymentTypes)
    {
        $this->paymentTypes = $paymentTypes;
    }

    public function getList()
    {
      return  $this->paymentTypes->get();

    }
}