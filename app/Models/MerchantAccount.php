<?php


namespace App\Models;

 use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantAccount extends BaseModel
{
    use SoftDeletes;
    protected $table = 'merchant_account';
    public $timestamps = false;
    protected $with = ['merchant'];
    protected $fillable = ['mfo', 'ed_rpo', 'checking_account', 'merchant_id'];


    public function merchant()
    {
        return $this->hasOne(Merchants::class, 'id', 'merchant_id');
    }


}