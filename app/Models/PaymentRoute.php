<?php


namespace App\Models;


class PaymentRoute extends BaseModel
{
    public $table = 'payment_routes';

    public $timestamps = ['updated', 'created'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';




    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type', 'id');
    }




}