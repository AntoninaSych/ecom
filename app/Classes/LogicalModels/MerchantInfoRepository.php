<?php


namespace App\Classes\LogicalModels;


use App\Exceptions\NotFoundException;
use App\Http\Requests\Merchant\UpdateMerchant;
use App\Models\MerchantInfo;
use App\Models\Merchants;
use App\Models\MerchantStatus;
use App\Models\MerchantUser;
use App\Models\OrderFieldValues;
use App\Models\Orders;
use App\User;
use Carbon\Carbon;
use mysql_xdevapi\Collection;

class MerchantInfoRepository
{
    protected $merchantInfo;
    protected $fieldValues;

    public function __construct(MerchantInfo $merchantInfo, OrderFieldValues $fieldValues)
    {
        $this->merchantInfo = $merchantInfo;
        $this->fieldValues = $fieldValues;
    }



    public function save(Orders $order)
    {
        $merchantInfo = $this->merchantInfo->select()->where('merchant_id', $order->merchant_id)->first();


        if (is_null($merchantInfo)) {
            $merchantInfo = new MerchantInfo();
        }

        $fields = $this->fieldValues->select()->where('order_id', $order->id)->get();

        foreach ($fields as $field) {
            if ($field->field->table_name !== 'merchants') {
                if(in_array($field->field->field_key,$merchantInfo->getDates()))
                {
                    $field->field_value = Carbon::createFromFormat('d-m-Y', $field->field_value);
                }

                $merchantInfo->fill([$field->field->field_key => $field->field_value]);
            }
        }

        $merchantInfo->merchant_id =  $order->merchant_id;

        $merchantInfo->save();

    }

}