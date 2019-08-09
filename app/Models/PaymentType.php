<?php


namespace App\Models;


class PaymentType extends BaseModel
{
    protected $table = 'ref_payment_types';
    protected $with = [  'paymentRoute' ];

    public function paymentRoute()
    {
        return $this->hasMany(PaymentRoute::class,  'id','payment_type');
    }
}