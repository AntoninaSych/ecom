<?php


namespace App\Classes\Filters;


use App\Models\Payments;
use  Illuminate\Support\Collection;

class CardFilter
{
    public static function filterCollection(Collection $collection): Collection
    {
        $collection->filter(function ($item) {
            if (!is_null($item->card_num)) {
                $item->card_num = substr_replace($item->card_num, '******', -10, 6);
            }
            return $item;
        })->values();

        return $collection;
    }

    public static function filterModel(Payments $payment): Payments
    {
        if (!is_null($payment->card_num)) {
            $payment->card_num = substr_replace($payment->card_num, '******', -10, 6);
        }

        return $payment;
    }
}