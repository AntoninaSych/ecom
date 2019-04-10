<?php


namespace App\Http\Controllers;


use App\Classes\LogicalModels\MerchantsRepository;
use App\Classes\LogicalModels\PaymentsRepository;
use App\Classes\LogicalModels\PaymentStatusRepository;
use App\Classes\LogicalModels\PaymentTypesRepository;
use Illuminate\Http\Request;

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
    //$card = '4275245675672511';
    //echo substr_replace($card, '******', -10, 6);
       return   $payments = $this->payments->getList();
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
}