<?php


namespace App\Models;


class MerchantsUserAlias extends BaseModel
{
    protected $table = 'users_merchants';

    public $timestamps = false;
    protected $with = ['userAlias'];


    protected $fillable  = ['role_id', 'merchant_id', 'user_id' ];

    public function userAlias()
    {
        return $this->hasMany(MerchantUser::class, 'id', 'user_id');
    }
}