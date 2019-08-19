<?php


namespace App\Classes\Helpers;


use App\Models\RefPaymentType;
use Illuminate\Support\Facades\Facade;

class RefPaymentTypes extends Facade
{
    public static function getList()
    {
        $types = new RefPaymentType();
        return $types->select()->get();
    }
}
