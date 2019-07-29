<?php


namespace App\Classes\Filters;


final class MerchantSearchFilter
{
    public $terminal = null;
    public $identifier = null;
    public $merchant_creator_user = false;
    public $concordpay_user = false;
    public $merchant_id = false;


    public static function create(array $requestArray): MerchantSearchFilter
    {
        $requestFilter = new self();
        $requestFilter->terminal = (isset($requestArray['terminal'])) ? $requestArray['terminal'] : null;
        $requestFilter->identifier = (isset($requestArray['identifier'])) ? $requestArray['identifier'] : null;

       //echo $requestFilter->identifier;die();
        $requestFilter->merchant_creator_user = (isset($requestArray['merchant_creator_user'])) ? $requestArray['merchant_creator_user'] : null;
        $requestFilter->concordpay_user = (isset($requestArray['concordpay_user'])) ? $requestArray['concordpay_user'] : null;
        $requestFilter->merchant_id = (isset($requestArray['merchant_id'])) ? $requestArray['merchant_id'] : null;

        return $requestFilter;
    }
}