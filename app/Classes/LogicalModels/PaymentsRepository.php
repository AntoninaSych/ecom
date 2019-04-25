<?php


namespace App\Classes\LogicalModels;


use App\Classes\Filters\CardFilter;
use App\Classes\Filters\SearchPaymentsFilter;
use App\Exceptions\NotFoundException;
use App\Models\Merchants;
use App\Models\Payments;
use App\Models\PaymentStatus;
use App\Models\PaymentType;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class PaymentsRepository
{
    protected $payments;
    protected $type;
    protected $status;
    protected $merchants;

    public function __construct(Payments $payments, PaymentStatus $status, PaymentType $type, Merchants $merchants)
    {
        $this->payments = $payments;
        $this->type = $type;
        $this->status = $status;
        $this->merchants = $merchants;
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
                'payments.updated',
                'payments.created',
                'payments.card_num',
                'payments.created',
                'payments.amount',
                'payments.customer_fee',
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
            $query = $query->where('payments.order_id', '=', $filter->numberOrder);
        }

        if (!is_null($filter->merchantId) && !empty($filter->merchantId)) {
            $query = $query->whereIn('payments.merchant_id', $filter->merchantId);
        }

        if (!is_null($filter->paymentStatus)) {
            $query = $query->where('status', $filter->paymentStatus);
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


//        if ($filter->createdTo != "" && $filter->createdFrom != "") {
//            $start_date = Carbon::createFromFormat('Y-m-d', $filter->createdFrom)->startOfDay()->toDateTimeString();
//            $end_date = Carbon::createFromFormat('Y-m-d', $filter->createdTo)->endOfDay()->toDateTimeString();
//            $query = $query->whereBetween('payments.created', [$start_date, $end_date]);
//        }
        if ($filter->updatedTo != "" && $filter->updatedFrom != "") {
            $start_date = Carbon::createFromFormat('Y-m-d', $filter->updatedFrom)->startOfDay()->toDateTimeString();
            $end_date = Carbon::createFromFormat('Y-m-d', $filter->updatedTo)->endOfDay()->toDateTimeString();
            $query = $query->whereBetween('payments.updated', [$start_date, $end_date]);
        }

        $query = $query->orderBy('payments.created', 'DESC');
        $results = $query->get();
        $results = CardFilter::filterCollection($results);

        return $results;
    }


    /**
     * @return Payments
     */
    public function getOneById(int $id): Payments
    {
        $payment = $this->payments->whereId($id)->first();

        $payment = CardFilter::filterModel($payment);

        if (empty($payment)) {
            throw new  NotFoundException('Платеж с данным id не существует');
        }

        return $payment;
    }
}