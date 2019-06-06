<?php


namespace App\Models;


class MerchantPaymentTypes extends BaseModel
{
    public $table = 'merchant_pament_types';

    protected $fillable = ['merchant_id', 'payment_type', 'fee_proc', 'fee_fix', 'enabled', 'fee_type'];

    protected $with = ['merchant', 'payment' ];

    public function merchant()
    {
        return $this->belongsTo(Merchants::class, 'merchant_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(RefPaymentType::class, 'payment_type', 'id');
    }
        // merchant_id и payment_type  must be unique
}