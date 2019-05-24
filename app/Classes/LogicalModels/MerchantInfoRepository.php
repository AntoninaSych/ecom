<?php


namespace App\Classes\LogicalModels;


use App\Exceptions\NotFoundException;
use App\Http\Requests\Merchant\UpdateMerchant;
use App\Models\MerchantAccount;
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
    protected $merchant;
    protected $merchantAccount;

    public function __construct(MerchantInfo $merchantInfo,
                                OrderFieldValues $fieldValues,
                                MerchantAccount $merchantAccount,
                                Merchants $merchant

    )
    {
        $this->merchantInfo = $merchantInfo;
        $this->fieldValues = $fieldValues;
        $this->merchantAccount = $merchantAccount;
        $this->merchant = $merchant;
    }


    public function save(Orders $order)
    {
        $merchantInfo = $this->merchantInfo->select()->where('merchant_id', $order->merchant_id)->first();
        $merchant = $this->merchant->select()->where('id', $order->merchant_id)->first();
        $merchantAccount = $this->merchantAccount->select()->where('merchant_id', $order->merchant_id)->first();


        if (is_null($merchantInfo)) {
            $merchant = new Merchants();
        }


        if (is_null($merchantInfo)) {
            $merchantAccount = new MerchantAccount();
        }

        if (is_null($merchantInfo)) {
            $merchantInfo = new MerchantInfo();
        }

        $fields = $this->fieldValues->select()->where('order_id', $order->id)->get();

        $accountTable = false;
        $merchantTable = false;
        $merchantInfoTable = false;

        foreach ($fields as $field) {
            if ($field->field->table_name = 'merchant_info') {
                if (in_array($field->field->field_key, $merchantInfo->getDates())) {
                    $field->field_value = Carbon::createFromFormat('d-m-Y', $field->field_value);
                }
                $merchantInfoTable = true;
                $merchantInfo->fill([$field->field->field_key => $field->field_value]);
                $merchantInfo->merchant_id = $order->merchant_id;

            }

            if ($field->field->table_name = 'merchant') {
                $merchantTable = true;
                $merchant->fill([$field->field->field_key => $field->field_value]);
            }

            if ($field->field->table_name = 'merchant_account') {
                $accountTable = true;
                $merchantAccount->fill([$field->field->field_key => $field->field_value]);
            }


        }

        if ($accountTable) {
            $merchantAccount->merchant_id = $order->merchant_id;
            $merchantAccount->save();
        }

        if ($merchantInfoTable) {
            $merchantInfo->merchant_id = $order->merchant_id;
            $merchantInfo->save();
        }

        if ($merchantTable) {
            $merchant->save();
        }

        $merchantInfo->save();
    }
}