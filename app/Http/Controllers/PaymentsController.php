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
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    /**
     * Data for Data tables
     * @return mixed
     */
    public function anyData()
    {
        $payments = $this->payments->getSearch(SearchPaymentsFilter::create($this->request->all()));
        return Datatables::of($payments)
            ->addColumn('id', function ($payments) {
                return   $payments->id  ;
            })
            ->editColumn('created', function ($payments) {
                return $payments->created;
            })
            ->editColumn('updated', function ($payments) {
                return $payments->updated;
            })
            ->editColumn('amount', function ($payments) {
                return $payments->amount;
            })
            ->editColumn('customer_fee', function ($payments) {
                return $payments->customer_fee;
            })
            ->editColumn('status', function ($payments) {
                return $payments->status;
            })
            ->editColumn('card_num', function ($payments) {
                return $payments->card_num;
            })
            ->editColumn('order_id', function ($payments) {
                return $payments->order_id;
            })
            ->editColumn('description', function ($payments) {
                return $payments->description;
            })
            ->addColumn('view_details', function ($payments) {
                return  '<a class="btn btn-black" href="/payments/view?id='.$payments->id.'"><i class="fa fa-fw fa-eye"></i></a>';
            })
            ->rawColumns(['view_details' ])
    ->make(true);
    }
}