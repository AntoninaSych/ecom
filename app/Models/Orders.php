<?php


namespace App\Models;

class Orders extends BaseModel
{

    protected $table = 'order';
    protected $with = ['user','merchant','status','securityUser','fraudUser','businessUser','declineUser','assignedUser' ];

    public function user()
    {
        return $this->hasOne(MerchantUser::class, 'id','user_id');
    }

    public function merchant()
    {
        return $this->hasOne(Merchants::class, 'id','merchant_id');
    }

    public function status()
    {
        return $this->hasOne(RefOrderStatus::class, 'id','order_status');
    }

    public function securityUser()
    {
        return $this->hasOne(Users::class, 'id','security_check');
    }

    public function fraudUser()
    {
        return $this->hasOne(Users::class, 'id','fraud_check');
    }

    public function businessUser()
    {
        return $this->hasOne(Users::class,  'id','business_check');
    }

    public function declineUser()
    {
        return $this->hasOne(Users::class,  'id','decline_user_id');
    }

    public function assignedUser()
    {
        return $this->hasOne(Users::class,  'id','assigned');
    }
}