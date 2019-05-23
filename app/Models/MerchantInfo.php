<?php


namespace App\Models;


class MerchantInfo extends BaseModel
{
    protected $table = 'merchant_info';
//    protected $dates = ['updated'];
    public $timestamps = false;
 //   protected $dateFormat = 'd-m-Y';
    protected $dates = [
        'created_at',
        'updated_at',
        'ind_birthday',
        'ur_birthday',
        'ind_contact_birthday'

    ];

    protected $fillable = ['mcc_id', 'personType', 'ind_contact_name', 'ind_contact_inn', 'ind_contact_birthday',
        'ind_contact_email', 'ind_contact_retail_name', 'ind_contact_city', 'ind_contact_address', 'ind_contact_region',
        'ind_contact_mail_index', 'ind_is_director', 'ind_is_director', 'ind_fio', 'ind_inn', 'ind_birthday', 'ind_phone',
        'ind_email', 'ur_retail_name', 'ur_city', 'ur_address', 'ur_region', 'ur_mail_index', 'ur_fio', 'ur_inn', 'ur_birthday',
        'ur_phone', 'ur_email', 'ur_fio_contact', 'ur_phone_contact', 'ur_email_contact', 'ind_contact_phone', 'ind_contact_email'
    ];


    protected $with = ['merchant_status',   'user', 'compensationType', 'compensationTerm', 'merchantType'];

    public function payments()
    {
        return $this->hasMany(Payments::class, 'id', 'merchant_id');
    }

    public function merchant_status()
    {
        return $this->belongsTo(MerchantStatus::class, 'status', 'id');
    }



    public function user()
    {
        return $this->belongsTo(MerchantUser::class, 'user_id', 'id');
    }

    public function compensationType()
    {
        return $this->belongsTo(MerchantCompensationType::class, 'compensation_type', 'id');
    }

    public function compensationTerm()
    {
        return $this->belongsTo(MerchantCompensationTerm::class, 'compensation_term', 'id');
    }

    public function merchantType()
    {
        return $this->belongsTo(MerchantType::class, 'compensation_term', 'id');
    }
}