<?php


namespace App\Models;


class PaymentRequest extends BaseModel
{
    public $table = 'payment_request';
    public $timestamps = ['updated_at', 'created_at'];
    protected $with = ['statusPrev', 'statusNext', 'userRequest','userResponse'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    //0 - new, 1-apllayed, 2-rejected, 3-canceled
    public function statusPrev()
    {
        return $this->belongsTo(PaymentStatus::class, 'from_status', 'id');
    }

    public function statusNext()
    {
        return $this->belongsTo(PaymentStatus::class, 'to_status', 'id');
    }

    public function userRequest()
    {
        return $this->belongsTo(Users::class, 'user_request', 'id');
    }

    public function userResponse()
    {
        return $this->belongsTo(Users::class, 'user_response', 'id');
    }

}