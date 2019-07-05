<?php


namespace App\Classes\Filters;


class StatisticPaymentFilter
{

    public $merchantId = array();
    public $updatedFrom = null;//дата платежа
    public $updatedTo = null;//дата платежа
    public $groupBy = null;

    public static function create(array $requestArray): StatisticPaymentFilter
    {
        $searchPayments = new self();

        $searchPayments->updatedFrom = (isset($requestArray['updated_from'])) ? $requestArray['updated_from'] : '';
        $searchPayments->updatedTo = (isset($requestArray['updated_to'])) ? $requestArray['updated_to'] : '';

        if (isset($requestArray['merchant_id']) && !empty($requestArray['merchant_id'])) {
            $searchPayments->merchantId = array_map(function ($merchant_id) {
                return intval($merchant_id);
            }, $requestArray['merchant_id']);

        }


        return $searchPayments;
    }
}