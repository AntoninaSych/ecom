<?php


namespace App\Models;


class MerchantPaymentLimits extends BaseModel
{
    public $table = 'merchant_limits';

    protected $fillable = ['merchant_id', 'payment_type', 'fee_proc', 'fee_fix', 'enabled', 'fee_type'];

    protected $with = ['merchant', 'cardSystem', 'limitTypes' ];

    public function merchant()
    {
        return $this->belongsTo(Merchants::class, 'merchant_id', 'id');
    }

    public function cardSystem()
    {
        return $this->belongsTo(CardSystems::class, 'card_system', 'id');
    }

    public function limitTypes()
    {
        return $this->belongsTo(CardSystems::class, 'card_system', 'id');
    }
}