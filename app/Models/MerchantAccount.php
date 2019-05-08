<?php


namespace App\Models;


class MerchantAccount extends BaseModel
{
    protected $table = 'merchant_account';
    public $timestamps = false;
    protected $with = ['merchant'];

    public function merchant()
    {
        return $this->hasOne(Merchants::class, 'id', 'merchant_id');
    }


}