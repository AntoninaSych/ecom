<?php


namespace App\Classes\Filters;


use  Illuminate\Support\Collection;

class CardFilter
{
    public static function filterCollection(Collection $collection)
    {
        $collection->filter(function ($item) {
            if (!is_null($item->card_num))
            {
                $item->card_num = substr_replace($item->card_num, '******', -10, 6);
            }
            return $item;
        })->values();

        return $collection;
    }
}