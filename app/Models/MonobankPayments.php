<?php


namespace App\Models;


class MonobankPayments extends BaseModel
{
    protected $table = 'monobank_payments';

    public function payment()
    {
        return $this->belongsTo(Payments::class, 'payment_id', 'id');
    }
}
