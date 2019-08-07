<?php


namespace App\Classes\LogicalModels;


use App\Models\PaymentRequest;
use App\Models\PaymentRequestStatusLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentRequestStatusLogRepository
{

    public static function log(Request $request, PaymentRequest $paymentRequest)
    {
    $log = new PaymentRequestStatusLog();
    $log->request = json_encode([ 'request'=> $request->all(),'user'=>Auth::user()->id, 'username'=>Auth::user()->name]) ;
    $log->response =  json_encode( $paymentRequest->attributesToArray());
    $log->save();

    }
}