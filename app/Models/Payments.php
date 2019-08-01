<?php


namespace App\Models;

use App\Classes\Filters\CardFilter;
use App\Models\BaseModel;

class Payments extends BaseModel
{
    protected $table = 'payments';


    public function merchant()
    {
        return $this->hasOne(Merchants::class, 'id', 'merchant_id');
    }

    public function paymentStatus()
    {
        return $this->hasOne(PaymentStatus::class, 'id', 'status');
    }

    public function paymentType()
    {
        return $this->hasOne(PaymentType::class, 'id', 'type');
    }

    public function paymentRoute()
    {
        return $this->belongsTo(PaymentRoute::class, 'route', 'id');
    }
}