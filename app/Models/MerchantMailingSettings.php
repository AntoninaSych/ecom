<?php


namespace App\Models;


class MerchantMailingSettings extends BaseModel
{
    public $table = 'merchant_mailing_settings';
    protected $with = ['merchantName'];

    public function merchantName()
    {
        return $this->belongsTo(Merchants::class, 'merchant_id', 'id');
    }
}
