<?php


namespace App\Classes\Filters;


final class SearchPaymentsFilter
{
    public $id = null;
    public $merchantId = array();
    public $createdDate = null;
    public $paymentType = null;
    public $paymentStatus = null;
    public $numberOrder = null;
    public $amount = null;
    public $cardNumber = null;
    public $description = null;

    public $createdFrom = null;//дата создания платежа
    public $createdTo = null;//дата создания платежа

    public $updatedFrom = null;//дата платежа
    public $updatedTo = null;//дата платежа



    public static function create(array $requestArray): SearchPaymentsFilter
    {
        $searchPayments = new self();
        $searchPayments->id = (isset($requestArray['id'])) ? $requestArray['id'] : null;
        $searchPayments->createdDate = (isset($requestArray['created_date'])) ? $requestArray['created_date'] : null;
        $searchPayments->paymentType = (isset($requestArray['payment_type'])) ? $requestArray['payment_type'] : null;
        $searchPayments->paymentType = (isset($requestArray['payment_type'])) ? $requestArray['payment_type'] : null;
        $searchPayments->paymentStatus = (isset($requestArray['payment_status'])) ? $requestArray['payment_status'] : null;
        $searchPayments->numberOrder = (isset($requestArray['number_order'])) ? $requestArray['number_order'] : null;
        $searchPayments->amount = (isset($requestArray['amount'])) ? $requestArray['amount'] : null;

        $searchPayments->cardNumber = (isset($requestArray['card_number'])) ? $requestArray['card_number'] : null;

        $searchPayments->description = (isset($requestArray['description'])) ? trim($requestArray['description']) : null;

        $searchPayments->updatedFrom = (isset($requestArray['updated_from'])) ? $requestArray['updated_from'] : '';
        $searchPayments->updatedTo = (isset($requestArray['updated_to'])) ? $requestArray['updated_to'] : '';

        $searchPayments->createdFrom = (isset($requestArray['created_from'])) ? $requestArray['created_from'] : '';
        $searchPayments->createdTo = (isset($requestArray['created_to'])) ? $requestArray['created_to'] : '';

        if (isset($requestArray['merchant_id']) && !empty($requestArray['merchant_id'])) {
            $searchPayments->merchantId  = array_map(function ($merchant_id) {
                return intval($merchant_id);
            }, $requestArray['merchant_id']);

        }


        return $searchPayments;
    }
}