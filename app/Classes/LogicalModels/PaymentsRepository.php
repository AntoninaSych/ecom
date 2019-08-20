<?php


namespace App\Classes\LogicalModels;


use App\Classes\Filters\CardFilter;
use App\Classes\Filters\SearchPaymentsFilter;
use App\Classes\Filters\StatisticPaymentFilter;
use App\Exceptions\NotFoundException;
use App\Models\Merchants;
use App\Models\PaymentRoute;
use App\Models\Payments;
use App\Models\PaymentStatus;
use App\Models\PaymentType;
use App\Models\ProcessingLog;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class PaymentsRepository
{
    protected $payments;
    protected $type;
    protected $status;
    protected $merchants;
    private $route;

    public function __construct(Payments $payments,
                                PaymentStatus $status,
                                PaymentType $type,
                                Merchants $merchants,
                                PaymentRoute $route)
    {
        $this->payments = $payments;
        $this->type = $type;
        $this->status = $status;
        $this->merchants = $merchants;
        $this->route = $route;
    }

    public function getList()
    {
        return $this->payments->get();
    }


    /**
     * @param SearchPaymentsFilter $filter
     * @return \Illuminate\Support\Collection
     *
     * make search by params:
     * [id],[created_date],[payment_type],[payment_status]:
     * [number_order],[amount],[card_number],[description]:
     * [created_from]: 2019-04-02, [created_to]: 2019-04-12
     */
    public function getSearch(SearchPaymentsFilter $filter)
    {
        $query = DB::table($this->payments->getTable() . ' as payments')
            ->select(
                'payments.id',
                'payments.order_id',
                'payments.created',
                'payments.card_num',
                'payments.created',
                'payments.amount',
                'payments.customer_fee',
                'payments.merchant_fee',
                'payments.merchant_id',
                'payments.description',
                'st.name  as  status',
                'st.name  as  type',
                'mer.name as merchant'
            )
            ->leftjoin($this->merchants->getTable() . ' as mer', 'payments.merchant_id', '=', 'mer.id')
            ->leftjoin($this->status->getTable() . ' as st', 'payments.status', '=', 'st.id')
            ->leftjoin($this->type->getTable() . ' as tp', 'payments.type', '=', 'tp.id');

        if (!is_null($filter->id)) {
            $query = $query->where('payments.id', '=', $filter->id);
        }

        if (!is_null($filter->numberOrder)) {
            $query = $query->where('payments.order_id', 'like', '%' . $filter->numberOrder . "%");
        }

        if (!is_null($filter->merchantId) && !empty($filter->merchantId)) {
            $query = $query->whereIn('payments.merchant_id', $filter->merchantId);
        }

        if (!is_null($filter->paymentStatus)) {
            $query = $query->where('st.id', $filter->paymentStatus);
        }

        if (!is_null($filter->paymentType)) {
            $query = $query->where('type', $filter->paymentType);
        }

        if (!is_null($filter->description)) {
            $query = $query->where('payments.description', 'like', '%' . $filter->description . "%");
        }

        if (!is_null($filter->cardNumber)) {
            $pan = substr($filter->cardNumber, 0, 6);
            $pan .= '%' . substr($filter->cardNumber, -4);
            $query = $query->where('payments.card_num', 'like', $pan);
        }


        if (!is_null($filter->amount)) {
            $query = $query->where('payments.amount', $filter->amount);
        }


        if ($filter->updatedTo != "" && $filter->updatedFrom != "") {
            $start_date = Carbon::createFromFormat('Y-m-d', $filter->updatedFrom)->startOfDay()->toDateTimeString();
            $end_date = Carbon::createFromFormat('Y-m-d', $filter->updatedTo)->endOfDay()->toDateTimeString();
        } else {
            $start_date = Carbon::now()->startOfDay()->toDateTimeString();
            $end_date = Carbon::now()->endOfDay()->toDateTimeString();
        }
        $query = $query->whereBetween('payments.created', [$start_date, $end_date]);
//        $query = $query->orderBy('payments.id', 'DESC'); //filters do not applies in this case

        return $query;
    }


    /**
     * @return Payments
     */
    public function getOneById(int $id): Payments
    {
        $payment = $this->payments->where('id', $id)->first();
        if (is_null($payment)) {
            throw new NotFoundException('Данный платеж не существует');
        }
        $payment = CardFilter::filterModel($payment);

        if (empty($payment)) {
            throw new  NotFoundException('Платеж с данным id не существует');
        }

        return $payment;
    }

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

    public function getStatistic(StatisticPaymentFilter $filter = null)
    {

        $query = DB::table($this->payments->getTable() . ' as payments')
            ->select(
                'payments.id',
                'payments.updated',
                'payments.amount',
                'payments.status',
                'payments.merchant_id',
                'mer.name',
                'rt.name'
            )
            ->leftjoin($this->merchants->getTable() . ' as mer', 'payments.merchant_id', '=', 'mer.id');

        if (!is_null($filter)) {
            if ($filter->updatedTo != null && $filter->updatedFrom != null) {
                $start_date = Carbon::createFromFormat('Y-m-d', $filter->updatedFrom)->startOfDay()->toDateTimeString();
                $end_date = Carbon::createFromFormat('Y-m-d', $filter->updatedTo)->endOfDay()->toDateTimeString();
                $query = $query->whereBetween('payments.created', [$start_date, $end_date]);
            }
        }


        $query = $query->where('payments.status', 7);
        $results = $query->sum('payments.amount');

        return $results;
    }

    public function top10ByMerchants(StatisticPaymentFilter $filter = null)
    {
        if (is_null($filter)) {

            $query = DB::select('select merchants.name,   sum(payments.amount) as summa from payments left JOIN merchants
ON  merchants.id = payments.merchant_id   where payments.status = 7 group By payments.merchant_id  ORDER BY summa DESC   limit 10');

        } else {
            $query = DB::table($this->payments->getTable())
                ->leftjoin($this->merchants->getTable(), 'payments.merchant_id', '=', 'merchants.id')
                ->select(DB::raw('merchants.name, sum(payments.amount) as summa'));
            $start_date = Carbon::createFromFormat('Y-m-d', $filter->updatedFrom)->startOfDay()->toDateTimeString();
            $end_date = Carbon::createFromFormat('Y-m-d', $filter->updatedTo)->endOfDay()->toDateTimeString();
            $query = $query->whereBetween('payments.created', [$start_date, $end_date]);
            $query = $query->where('payments.status', 7);
            $query = $query->groupBy('payments.merchant_id');
            $query = $query->orderBy('summa', 'desc');
            $query = $query->limit(10)->get();
        }

        return $query;
    }


    public function getStatisticByRoute(StatisticPaymentFilter $filter = null)
    {
        $query = DB::table($this->payments->getTable() . ' as payments')
            ->select(DB::raw('rt.name, cs.name as sc_name,   rt.name, sum(payments.amount) as summa')
            )
            ->leftjoin($this->route->getTable() . ' as rt', 'payments.route', '=', 'rt.id')
            ->join('cards_systems as cs', 'payments.card_system', '=', 'cs.id');


        if (!is_null($filter)) {
            if ($filter->updatedTo != null && $filter->updatedFrom != null) {
                $start_date = Carbon::createFromFormat('Y-m-d', $filter->updatedFrom)->startOfDay()->toDateTimeString();
                $end_date = Carbon::createFromFormat('Y-m-d', $filter->updatedTo)->endOfDay()->toDateTimeString();
                $query = $query->whereBetween('payments.created', [$start_date, $end_date]);
            }
        }
        $query = $query->where('payments.status', 7);
        $query = $query->groupBy('rt.name', 'cs.name');
        $result = $query->get();

        return $result;
    }

    public function save(Payments $payment)
    {
        //todo LOG
        $payment->save();
    }

    public function getChartByMerchant($idMerchant, $date_from, $date_to)
    {

        $start_date = Carbon::createFromFormat('Y-m-d', $date_from)->startOfDay();
        $end_date = Carbon::createFromFormat('Y-m-d', $date_to)->endOfDay();


            $data = DB::table('payments')
                ->select(DB::raw('(created) as dt, sum(amount) as value'))
                ->where('status', 7)
                ->where('merchant_id', $idMerchant)
                ->whereBetween('payments.created', [$start_date, $end_date])
                ->groupBy('dt')
                ->get();

            return $data;


        return $data;
    }
}
