<?php


namespace App\Classes\LogicalModels;


use App\Models\PaymentRoute;

class PaymentRoutesRepository
{
    protected $paymentRoute;

    public function __construct(PaymentRoute $paymentRoute)
    {
        $this->paymentRoute = $paymentRoute;
    }

    public function list()
    {
        $results = $this->paymentRoute->select()->get();
        return $results;
    }

    public function getByPaymentType(int $paymentTypeId)
    {
        $results = $this->paymentRoute->select()->where('payment_type', $paymentTypeId)->get();

        return $results;
    }

    public function bySnippet($snippetId)
    {
        $results = $this->paymentRoute->select()->where('snippet_id', $snippetId)->get();

        return $results;
    }
}