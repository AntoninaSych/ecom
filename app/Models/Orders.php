<?php


namespace App\Models;



class Orders extends BaseModel
{
    protected $table = 'order';
    protected $with = ['users','merchant','status','securityStageCheck','fraudStageCheck','businessStageCheck' ];

    public function users()
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

    public function securityStageCheck()
    {
        return $this->hasOne(RefOrderCheckStage::class, 'id','security_check');
    }

    public function fraudStageCheck()
    {
        return $this->hasOne(RefOrderCheckStage::class, 'id','fraud_check');
    }

    public function businessStageCheck()
    {
        return $this->hasOne(RefOrderCheckStage::class, 'id','business_check');
    }
}