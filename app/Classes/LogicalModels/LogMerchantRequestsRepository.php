<?php


namespace App\Classes\LogicalModels;



use App\Models\LogMerchantRequests;
use Illuminate\Http\Request;

/**
 * Class LogMerchantRequestsRepository
 * @package App\Classes\LogicalModels
 */
class LogMerchantRequestsRepository
{
    protected $logMerchantRequests;


    /**
     * LogMerchantRequestsRepository constructor.
     * @param LogMerchantRequests $logMerchantRequests
     */
    public function __construct(LogMerchantRequests $logMerchantRequests)
    {
        $this->logMerchantRequests = $logMerchantRequests;

    }

    public static function log(  $merchantId, Request $request, array $response)
    {
        $log = new LogMerchantRequests();
        $log->merchant_id = $merchantId;
        $log->request_body	 = json_encode($request->all());
        $log->response_body =  json_encode($response);
        $log->save();
    }
}