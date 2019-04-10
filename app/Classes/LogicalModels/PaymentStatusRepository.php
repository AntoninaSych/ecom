<?php


namespace App\Classes\LogicalModels;

use App\Models\PaymentStatus;

class PaymentStatusRepository
{
    protected $status;

    public function __construct(PaymentStatus $status)
    {
        $this->status = $status;
    }

    public function getList()
    {
        return $this->status->get();
    }

}