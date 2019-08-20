<?php


namespace App\Models;

use App\Classes\Filters\CardFilter;
use App\Models\BaseModel;

class Payments extends BaseModel
{
    protected $table = 'payments';
    public $timestamps = ['updated', 'created'];

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

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

    public function  fkSystem()
    {
        return $this->belongsTo(FcSystemaPayments::class, 'id', 'payment_id');
    }

    public function  monobank()
    {
        return $this->belongsTo(MonobankPayments::class, 'id', 'payment_id');
    }
}