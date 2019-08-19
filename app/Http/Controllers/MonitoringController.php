<?php


namespace App\Http\Controllers;

use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\ProcessingLogRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        return $this->paymentsLog->getPaymentLogOnline($from, $to);
    }

    public function getTechData()
    {
        $validator = Validator::make($this->request->all(), [
            'payment_type' => 'sometimes|array|nullable',
            'date_from' => 'required',
            'date_to' => 'required',
        ]);


        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $from = Carbon::createFromFormat('Y-m-d', $this->request->get('date_from'))->startOfDay();
                $to = Carbon::createFromFormat('Y-m-d', $this->request->get('date_to'))->endOfDay();
                return $this->paymentsLog->getArchiveData($from, $to, $this->request->get('payment_type'));
            } catch (\Throwable $exception) {
                return ApiResponse::badResponse('Невозможно построить график');
            }
        }
    }
}
