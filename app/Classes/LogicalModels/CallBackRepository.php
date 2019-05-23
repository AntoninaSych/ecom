<?php


namespace App\Classes\LogicalModels;


use App\Models\CallbackLog;
use Illuminate\Support\Collection;


class CallBackRepository
{
    public function getByPaymentId(int $paymentId): Collection
    {
        $callbackLog = CallbackLog::where('payment_id', '=', $paymentId)->get();


        return $callbackLog;
    }

}