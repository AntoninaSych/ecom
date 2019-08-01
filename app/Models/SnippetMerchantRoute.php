<?php


namespace App\Models;


class SnippetMerchantRoute extends BaseModel
{
    public $table = 'snippet_merchant_route';
    protected $with = ['cardSystem','paymentRoute'];
    protected $fillable = ['payment_route_id', 'sum_min', 'sum_max', 'card_system',
        'bins', 'priority', 'final'];

    public function cardSystem()
    {
        return $this->belongsTo(CardSystems::class, 'card_system', 'id');
    }

    public function paymentRoute()
    {
        return $this->belongsTo(PaymentRoute::class, 'payment_route_id', 'id');
    }
}