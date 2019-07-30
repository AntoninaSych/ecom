<?php


namespace App\Http\Controllers;


use App\Classes\Filters\CardFilter;
use App\Classes\Filters\SearchPaymentsFilter;
use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\PermissionHelper;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\CallBackRepository;
use App\Classes\LogicalModels\MerchantsRepository;
use App\Classes\LogicalModels\PaymentsRepository;
use App\Classes\LogicalModels\PaymentStatusRepository;
use App\Classes\LogicalModels\PaymentTypesRepository;
use App\Exceptions\NotFoundException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

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


    public function index()
    {
        $this->merchants = $this->merchants->getList(5);
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

            $payment = $this->payments->getOneById($this->request->get('id'));

            $callBackLog = new CallBackRepository();
            $callBackLog = $callBackLog->getByPaymentId($payment->id);

        return view('payments.view')->with([
            'payment' => $payment,
            'callBackLog' => $callBackLog
        ]);
    }

    public function getProcessLog()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'integer'
        ]);
        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        }
        try {
            $processLog = null;
            if (Auth::user()->can(PermissionHelper::PROCESS_LOG_VIEW)) {
                $processLog = $this->payments->getProcessingLog($this->request->get('id'));
            }
        } catch (NotFoundException $e) {
            return ApiResponse::badResponse($e->getMessage(), $e->getCode());
        }

        return ApiResponse::goodResponse(['processLog' => $processLog]);
    }

    /**
     * Data for Data tables
     * @return mixed
     */
    public function anyData()
    {
        $payments = $this->payments->getSearch(SearchPaymentsFilter::create($this->request->all()));

        return Datatables::query($payments)
            ->addColumn('id', function ($payments) {
                return $payments->id;
            })
//            ->editColumn('created', function ($payments) {
//                return $payments->created;
//            })
            ->editColumn('created', function ($payments) {
                return $payments->created;
            })
            ->editColumn('amount', function ($payments) {
                return str_replace('.',',',$payments->amount);
            })
            ->editColumn('customer_fee', function ($payments) {
                return $payments->customer_fee + $payments->merchant_fee ;
            })
            ->editColumn('status', function ($payments) {
                return $payments->status;
            })
            ->editColumn('merchant', function ($payments) {
                return $payments->merchant;
            })
            ->editColumn('card_num', function ($payments) {
                if(!is_null($payments->card_num)){   return CardFilter::filterString($payments->card_num);}else{
                    return '';
                }
            })
            ->editColumn('order_id', function ($payments) {
                return $payments->order_id;
            })
            ->editColumn('description', function ($payments) {
                return $payments->description;
            })
            ->addColumn('view_details', function ($payments) {
                return '<a class="btn btn-black" href="/payments/view?id=' . $payments->id . '"><i class="fa fa-fw fa-eye"></i></a>';
            })
            ->rawColumns(['view_details'])
            ->make(true);
    }
}