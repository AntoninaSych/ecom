<?php


namespace App\Classes\LogicalModels;


use App\Classes\Filters\CardFilter;
use App\Models\Merchants;
use App\Models\PaymentRoute;
use App\Models\Payments;
use App\Models\PaymentStatus;
use App\Models\PaymentType;
use App\Models\ProcessingLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProcessingLogRepository
{
//    protected $payments;
//    protected $type;
//    protected $status;
//    protected $merchants;
//    private $route;
//
//    public function __construct(Payments $payments,
//                                PaymentStatus $status,
//                                PaymentType $type,
//                                Merchants $merchants,
//                                PaymentRoute $route)
//    {
//        $this->payments = $payments;
//        $this->type = $type;
//        $this->status = $status;
//        $this->merchants = $merchants;
//        $this->route = $route;
//    }

    public function getProcessingLog($paymentId)
    {
        $processingLog = new ProcessingLog();

        $processingLog = $processingLog->where('payment_id', $paymentId)->get();

        foreach ($processingLog as $log) {
            if ($this->isJson($log->request_body) === true) {
                $log->request_body = json_decode($log->request_body, true);

                if (isset($log->request_body['Request']['PAN'])) {
                    // $log->request_body['Request']['PAN'] =  CardFilter::filterString(    $log->request_body['Request']['PAN'] );
                    $temp = $log->request_body;

                    $temp['Request']['PAN'] = CardFilter::filterString($log->request_body['Request']['PAN']);
                    $log->request_body = $temp;
                }

                $log->request_body = json_encode($log->request_body);
            }
        }

        return $processingLog;
    }

    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function getPaymentLogOnline($from, $to)
    {
        $paymentsLog = $processingLog = new ProcessingLog();

        $processingLog = DB::table('processing_log')
            ->select(DB::raw('  request_time  as value, ts '))
            ->whereBetween('ts', [$from, $to])
            ->groupBy('ts')
            ->get();

        return $processingLog;
    }

    public function getTechData($from, $to, $payment_type)
    {
        $paymentsLog = new ProcessingLog();

        $paymentsLog = DB::table('payments')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS  `created` as created, COUNT(`id`) as count'))
            ->whereBetween('created', [$from, $to]);
        if (!is_null($payment_type)) {
            $paymentsLog = $paymentsLog->whereIn('type', $payment_type);
        }
        $paymentsLog = $paymentsLog->groupBy('created')->get();

        return $paymentsLog;
    }


}
