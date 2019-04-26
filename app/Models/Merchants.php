<?php


namespace App\Models;



class Merchants extends BaseModel
{
    protected $table = 'merchants';
    protected $with = ['status','user','compensationType','compensationTerm','merchantType'];

    public function payments()
    {
        return $this->hasMany(Payments::class, 'id', 'merchant_id');
    }

    public function status()
    {
        return $this->belongsTo(MerchantStatus::class,'status','id');
    }

    public function user()
    {
        return $this->belongsTo(MerchantUser::class,'user_id','id');
    }

    public function compensationType()
    {
        return $this->belongsTo(MerchantCompensationType::class,'compensation_type','id');
    }

    public function compensationTerm()
    {
        return $this->belongsTo(MerchantCompensationTerm::class,'compensation_term','id');
    }

    public function merchantType()
    {
        return $this->belongsTo(MerchantType::class,'compensation_term','id');
    }
}