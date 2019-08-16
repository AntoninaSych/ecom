<?php


namespace App\Http\Controllers;

use App\Classes\LogicalModels\ProcessingLogRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonitoringController
{
    public $paymentsLog;
    public $request;

    public function __construct(ProcessingLogRepository $paymentsRepository,
                                Request $request)
    {
        $this->paymentsLog = $paymentsRepository;
        $this->request = $request;
    }

    public function index()
    {

        return view('monitoring.index');
    }

    public function getPaymentLogOnline()
    {

        //  $from = Carbon::createFromFormat('Y-m-d', '2019-08-17')->startOfDay();
//        $to = Carbon::createFromFormat('Y-m-d','2019-08-17')->endOfDay();


        $from = Carbon::now()->startOfDay();
        $to = Carbon::now()->endOfDay();


        return  $this->paymentsLog->getPaymentLogOnline($from,$to);
    }
}
