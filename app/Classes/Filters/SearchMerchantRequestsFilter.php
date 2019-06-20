<?php


namespace App\Classes\Filters;


final class SearchMerchantRequestsFilter
{
    public $id = null;
    public $department = null;
    public $archive = false;


    public static function create(array $requestArray): SearchMerchantRequestsFilter
    {
        $requestFilter = new self();
        $requestFilter->id = (isset($requestArray['id'])) ? $requestArray['id'] : null;
        $requestFilter->department = (isset($requestArray['department'])) ? $requestArray['department'] : null;

        return $requestFilter;
    }
}