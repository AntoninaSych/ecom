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
        $to = Carbon::now();
        $from = Carbon::now()->startOfDay();

        $this->paymentsLog->getPaymentLogOnline($from,$to);
    }
}
