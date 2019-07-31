<?php


namespace App\Models;


class MerchantPaymentRoute extends BaseModel
{
    public $table = 'merchant_routes';

    public $timestamps = ['updated', 'created'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    protected $fillable = ['payment_route_id',  'sum_min', 'sum_max', 'merchant_id','card_system',
        'bins', 'priority','final'];

    protected $with = ['merchant', 'paymentRoute', 'cardSystem'];

    public function merchant()
    {
        return $this->belongsTo(Merchants::class, 'merchant_id', 'id');
    }

    public function paymentRoute()
    {
        return $this->belongsTo(PaymentRoute::class, 'payment_route_id', 'id');
    }

    public function cardSystem()
    {
        return $this->belongsTo(CardSystems::class, 'card_system', 'id');
    }

}