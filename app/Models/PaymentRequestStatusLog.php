<?php


namespace App\Models;


class PaymentRequestStatusLog extends BaseModel
{
    public $table = 'payment_request_logs';

    protected $fillable  = ['payment_id', 'request', 'response' ];

    public function payment()
    {
        return $this->belongsTo(Payments::class, 'payment_id', 'id');
    }
}