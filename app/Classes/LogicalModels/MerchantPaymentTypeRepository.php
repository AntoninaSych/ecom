<?php


namespace App\Classes\LogicalModels;


use App\Models\MerchantPaymentTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Classes\LogicalModels\LogMerchantRequestsRepository;

class MerchantPaymentTypeRepository
{
    public $merchantPaymentTypes;

    public function __construct(MerchantPaymentTypes $merchantPaymentTypes)
    {
        $this->merchantPaymentTypes = $merchantPaymentTypes;
    }

    public function list($merchantId)
    {
        return $this->merchantPaymentTypes->select()->where('merchant_id', $merchantId)->get();
    }

    /**
     * @param MerchantPaymentTypes $merchantPaymentTypes
     * merchant_id and payment_type must be unique
     */
    public function save(MerchantPaymentTypes $merchantPaymentTypes)
    {
        $query = DB::table($this->merchantPaymentTypes->getTable() . ' as paymentType');
        $query = $query->where('paymentType.payment_type', '=', $merchantPaymentTypes->payment_type);
        $query = $query->where('paymentType.merchant_id', '=', $merchantPaymentTypes->merchant_id);
        if (isset($merchantPaymentTypes->id)) {
            $query = $query->where('paymentType.id', '!=', $merchantPaymentTypes->id);
        }
        $results = $query->get();

        if (count($results->toArray()) == 0) {

            LogMerchantRequestsRepository::log($merchantPaymentTypes->merchant_id,
                new Request($merchantPaymentTypes->toArray()),
                ['action'=>'save merchant payment type','user'=>Auth::user()]);

            $merchantPaymentTypes->save();
        }
    }

    public function getOne(int $id)
    {
        $merchantPaymentType = $this->merchantPaymentTypes->select()->where('id', $id)->first();

        return $merchantPaymentType;
    }


}