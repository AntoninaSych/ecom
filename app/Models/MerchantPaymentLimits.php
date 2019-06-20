<?php


namespace App\Models;


class MerchantPaymentLimits extends BaseModel
{
    public $table = 'merchant_limits';

    protected $fillable = ['merchant_id', 'amount', 'card_system', 'limit_types'];

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
        return $this->belongsTo(RefLimitType::class, 'limit_types', 'id');
    }
    //['merchant_id', 'limit_types','card_system'] must be unique
}