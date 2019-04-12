<?php


namespace App\Http\Controllers;


use App\Classes\Filters\SearchPaymentsFilter;
use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\CallBackRepository;
use App\Classes\LogicalModels\MerchantsRepository;
use App\Classes\LogicalModels\PaymentsRepository;
use App\Classes\LogicalModels\PaymentStatusRepository;
use App\Classes\LogicalModels\PaymentTypesRepository;
use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends Controller
{
    protected $request;
    protected $merchants;
    protected $paymentTypes;
    protected $paymentStatuses;
    protected $payments;

    public function __construct(Request $request,
                                MerchantsRepository $merchantsRepository,
                                PaymentTypesRepository $paymentTypes,
                                PaymentStatusRepository $paymentStatuses,
                                PaymentsRepository $paymentsRepository

    )
    {
        $this->request = $request;
        $this->merchants = $merchantsRepository;
        $this->paymentTypes = $paymentTypes;
        $this->paymentStatuses = $paymentStatuses;
        $this->payments = $paymentsRepository;
    }


    public function getSearchResponse()
    {


//        $validator = Validator::make($this->request->all(), [
//            'id' => 'integer',
//            'merchant_id' => 'array',
//            'created_date' => 'date',
//            'payment_type' => 'integer',
//            'payment_status' => 'integer',
//            'number_order' => 'integer',
//            'amount' => 'integer',
//            'card_number' => 'string',
//            'description' => 'string',
//            'created_from' => 'date',
//            'created_tp' => 'date',
//        ]);


//        if ($validator->fails()) {
//            return ApiResponse::badResponse("Данные для поиска не валидны", 401);
////            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
//        } else {
        try {
            return ApiResponse::goodResponseSimple($this->payments->getSearch(SearchPaymentsFilter::create($this->request->all())));
        } catch (NotFoundException $e) {
            return ApiResponse::badResponse($e->getMessage(), $e->getCode());
        }
//        }


    }

    public function payments()
    {
        $this->merchants = $this->merchants->getListLimited();
        $this->paymentTypes = $this->paymentTypes->getList();
        $this->paymentStatuses = $this->paymentStatuses->getList();

        return view('payments.payments')->with([
            'merchants' => $this->merchants,
            'paymentTypes' => $this->paymentTypes,
            'paymentStatuses' => $this->paymentStatuses
        ]);
    }

    public function getOneById()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'integer'
        ]);
        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        }
        try {
            $payment = $this->payments->getOneById($this->request->get('id'));

            $callBackLog = new CallBackRepository();
            $callBackLog = $callBackLog->getByPaymentId($payment->id);
        } catch (NotFoundException $e) {
            return ApiResponse::badResponse($e->getMessage(), $e->getCode());
        }

        return view('payments.view')->with([
            'payment' => $payment,
            'callBackLog' => $callBackLog
        ]);

    }
}