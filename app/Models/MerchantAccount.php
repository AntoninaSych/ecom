<?php


namespace App\Models;

 use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantAccount extends BaseModel
{
    use SoftDeletes;
    protected $table = 'merchant_account';
    public $timestamps = false;
    protected $with = ['merchant'];

    public function merchant()
    {
        return $this->hasOne(Merchants::class, 'id', 'merchant_id');
    }


}