<?php


namespace App\Classes\Filters;


use Carbon\Carbon;

class ExecuteFilter
{

    public $startDate = null;
    public $endDate = null;
    public $merchantId = null;

    public static function createFilter(array $request): ExecuteFilter
    {
        $searchFilter = new self();

        $searchFilter->startDate = (isset($request['start_date'])) ? Carbon::createFromFormat('Y-m-d', $request['start_date'])->startOfDay()->toDateTimeString() : null;
        $searchFilter->endDate = (isset($request['end_date'])) ? Carbon::createFromFormat('Y-m-d', $request['end_date'])->endOfDay()->toDateTimeString() : null;
        $searchFilter->merchantId = (isset($request['merchant_id'])) ? $request['merchant_id'] : null;

        return $searchFilter;
    }

    public static function toArray(ExecuteFilter $searchFilter)
    {
        $newArray = [];
        if(!is_null($searchFilter->startDate)  )
        {
            $newArray['start_date'] = $searchFilter->startDate;
        }

        if(!is_null($searchFilter->endDate)  )
        {
            $newArray['end_date'] = $searchFilter->endDate;
        }

        if(!is_null($searchFilter->merchantId)  )
        {
            $newArray['merchant_id'] = $searchFilter->merchantId;
        }

        return $newArray;
    }

}
