<?php


namespace App\Models;




class ApplePaySettings extends BaseModel
{
    protected $table = 'apple_pay_settings';

    public $timestamps = false;
//    protected $with = ['merchant'];
    protected $fillable = [ 'merchant_id', 'merchant_identifier', 'domain_name'];

//    public function merchant()
//    {
//        return $this->belongsTo(Merchants::class, 'id','merchant_identifier');
//    }
}