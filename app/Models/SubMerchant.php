<?php


namespace App\Models;

 use Illuminate\Database\Eloquent\SoftDeletes;

class SubMerchant extends BaseModel
{
    use SoftDeletes;
    protected $table = 'sub_merchants';
    public $timestamps = false;
    protected $with = ['merchant'];
    protected $fillable = ['sub_merchant_id', 'merchant_id', 'status', 'transit_acc','name'];


    public function merchant()
    {
        return $this->hasOne(Merchants::class, 'id', 'merchant_id');
    }


}
