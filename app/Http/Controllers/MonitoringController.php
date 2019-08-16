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
        $from = Carbon::now()->subHours(3);
        $to = Carbon::now()->endOfDay();

        return  $this->paymentsLog->getPaymentLogOnline($from,$to);
    }

    public function getArchiveData()
    {
       $from = Carbon::createFromFormat('Y-m-d', '2019-05-01')->startOfDay();
       $to = Carbon::createFromFormat('Y-m-d','2019-08-17')->endOfDay();

        return  $this->paymentsLog->getArchiveData($from,$to);
    }
}
