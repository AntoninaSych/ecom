<?php


namespace App\Classes\Filters;


final class MerchantSearchFilter
{
    public $terminal = null;
    public $identifier = null;
    public $merchant_creator_user = false;
    public $concordpay_user = false;
    public $merchant_id = false;

    public $order = null;

    public static function create(array $requestArray): MerchantSearchFilter
    {
        $requestFilter = new self();

        if(count($requestArray['order'])!=0)
        {
            if($requestArray['order'][0]['column']==0) {
                $requestFilter->order[]=['column'=>'merchants.id','dir'=>$requestArray['order'][0]['dir']];
            }
        }

        $requestFilter->terminal = (isset($requestArray['terminal'])) ? $requestArray['terminal'] : null;
        $requestFilter->identifier = (isset($requestArray['identifier'])) ? $requestArray['identifier'] : null;

       //echo $requestFilter->identifier;die();
        $requestFilter->merchant_creator_user = (isset($requestArray['merchant_creator_user'])) ? $requestArray['merchant_creator_user'] : null;
        $requestFilter->concordpay_user = (isset($requestArray['concordpay_user'])) ? $requestArray['concordpay_user'] : null;
        $requestFilter->merchant_id = (isset($requestArray['merchant_id'])) ? $requestArray['merchant_id'] : null;

        return $requestFilter;
    }
}