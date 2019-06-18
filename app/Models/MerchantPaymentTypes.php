<?php


namespace App\Models;


class MerchantPaymentTypes extends BaseModel
{
    public $table = 'merchant_pament_types';

    public $timestamps = ['updated', 'created'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    protected $fillable = ['merchant_id', 'payment_type', 'fee_proc', 'fee_fix', 'enabled', 'fee_type'];

    protected $with = ['merchant', 'payment', 'feeType','paymentRoute'];

    public function merchant()
    {
        return $this->belongsTo(Merchants::class, 'merchant_id', 'id');
    }

    public function feeType()
    {
        return $this->belongsTo(RefFeeType::class, 'fee_type', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(RefPaymentType::class, 'payment_type', 'id');
    }
    // [merchant_id и payment_type]  must be unique

    public function paymentRoute()
    {
        return $this->hasOne(PaymentRoute::class,  'id','payment_type');
    }
}