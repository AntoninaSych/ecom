<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Merchants extends BaseModel
{
    protected $table = 'merchants';

    public function payments()
    {
        return $this->hasMany(Payments::class, 'id', 'merchant_id');
    }

    public function status()
    {

        return $this->hasOne(MerchantStatus::class,'id','status');
    }

}