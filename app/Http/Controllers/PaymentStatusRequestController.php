<?php


namespace App\Http\Controllers;


use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;

use App\Classes\LogicalModels\PaymentRequestRepository;
use App\Classes\LogicalModels\PaymentsRepository;

use App\Exceptions\NotFoundException;
use App\Models\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentStatusRequestController
{

    protected $request;
    protected $merchants;
    protected $paymentTypes;
    protected $paymentStatuses;
    protected $payments;
    protected $paymentRequest;

    public function __construct(Request $request,
                                PaymentsRepository $paymentsRepository,
                                PaymentRequestRepository $paymentRequest

    )
    {

        $this->paymentRequest = $paymentRequest;
        $this->request = $request;

        $this->payments = $paymentsRepository;
    }

    public function changeStatusRequest()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer|exists:payments,id',
            'status' => 'required|integer',
            'comment' => 'required|string',
        ]);

        if ($validator->fails()) {


            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $payment = $this->payments->getOneById($this->request->get('id'));

                $paymentRequest = new PaymentRequest();
                $paymentRequest->payment_id = $payment->id;
                $paymentRequest->from_status = $payment->status;
                $paymentRequest->to_status = $this->request->get('status');
                $paymentRequest->user_request = Auth::user()->id;
                $paymentRequest->comment_request = $this->request->get('comment');
                $paymentRequest->is_applied = $this->request->get('comment');
                $this->paymentRequest->createRequest($paymentRequest);

                $list = $this->paymentRequest->byPayment($payment->id);
                return ApiResponse::goodResponseSimple($list);
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }

    public function list()
    {
        $statusRequest = $this->paymentRequest->list();
        return view('payments.statusRequest.list')->with([
            'statusRequest' => $statusRequest
        ]);
    }

    public function changeStatusResponse()
    {

        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer|exists:payment_request,id',
            'comment' => 'required|string',
            'action' => "required",
        ]);

        if ($validator->fails()) {

            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $paymentRequest = $this->paymentRequest->getOneById($this->request->get('id'));
                $paymentRequest->user_response = Auth::user()->id;
                $paymentRequest->comment_response = $this->request->get('comment');
                $paymentRequest->comment_response = $this->request->get('comment');

                if( $this->request->get('action')==='decline')
                {
                    $paymentRequest->is_applied = 2;
                }

                if( $this->request->get('action')==='apply')
                {
                    $paymentRequest->is_applied = 1;

                    $payment =  $this->payments->getOneById($paymentRequest->payment_id);
                    $payment->status = $paymentRequest->to_status;
                    $this->payments->save($payment);
                }
                $this->paymentRequest->save($paymentRequest);

                return ApiResponse::goodResponseSimple('');
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }
}