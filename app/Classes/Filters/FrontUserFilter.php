<?php


namespace App\Classes\Filters;


class FrontUserFilter
{
    public  $created_from;
    public  $created_to;

    public static function create(array $requestArray): FrontUserFilter
    {
        $requestFilter = new self();
        $requestFilter->created_from = (isset($requestArray['created_from'])) ? $requestArray['created_from'] : null;
        $requestFilter->created_to = (isset($requestArray['created_to'])) ? $requestArray['created_to'] : null;

        return $requestFilter;
    }
}
