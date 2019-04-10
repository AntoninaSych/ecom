<?php


namespace App\Classes\LogicalModels;


use App\Models\Payments;

class PaymentsRepository
{
    protected $payments;

    public function __construct(Payments $payments)
    {
        $this->payments = $payments;
    }

    public function getList()
    {
        return $this->payments->get();
    }

    public function getSearchResponse()
    {

        return $this->payments->get();
    }

}