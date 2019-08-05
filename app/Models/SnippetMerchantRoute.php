<?php


namespace App\Models;


class SnippetMerchantRoute extends BaseModel
{
    public $table = 'snippet_merchant_route';
    protected $with = ['cardSystem','paymentRoute','snippetName'];
    protected $fillable = ['payment_route_id', 'sum_min', 'sum_max', 'card_system',
        'bins', 'priority', 'final','snippet_id'];


    public function cardSystem()
    {
        return $this->belongsTo(CardSystems::class, 'card_system', 'id');
    }

    public function paymentRoute()
    {
        return $this->belongsTo(PaymentRoute::class, 'payment_route_id', 'id');
    }

    public function snippetName()
    {
        return $this->belongsTo(SnippetMerchant::class, 'snippet_id', 'id');
    }
}