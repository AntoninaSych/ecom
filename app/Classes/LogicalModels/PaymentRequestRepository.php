<?php


namespace App\Classes\LogicalModels;


use App\Models\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentRequestRepository
{

    public function createRequest(PaymentRequest $paymentRequest, Request $request): void
    {
        //todoLog
        $list = new PaymentRequest();
        $list = $list->select()->where('payment_id', $paymentRequest->payment_id)->get();
        foreach ($list as $item) {
            if ($item->is_applied == 0) {
                $item->is_applied = 3;
                $item->user_response = Auth::user()->id;
                $item->comment_response = "создана новая заявка";
                $item->save();
                PaymentRequestStatusLogRepository::log($request, $item);

            }
        }
        PaymentRequestStatusLogRepository::log($request, $paymentRequest);
        $paymentRequest->save();
    }

    public function save(PaymentRequest $paymentRequest, Request $request)
    {
        PaymentRequestStatusLogRepository::log($request, $paymentRequest);

        $paymentRequest->save();
    }

    public function getOneById($requestId)
    {
        $list = new PaymentRequest();
        return $list->select()->where('id', $requestId)->orderBy('id', 'desc')->first();
    }

    public function byPayment($paymentId)
    {
        $list = new PaymentRequest();
        return $list->select()->where('payment_id', $paymentId)->orderBy('id', 'desc')->get();
    }

    public function list()
    {
       return PaymentRequest::paginate(15);
    }
}