<?php


namespace App\Models;


class MerchantInfo extends BaseModel
{
    protected $table = 'merchant_info';
//    protected $dates = ['updated'];
    public $timestamps = false;
   protected $dateFormat = 'Y-m-d';
    protected $dates = [
//        'created_at',
//        'updated_at',
        'ind_birthday',
        'ur_birthday',
        'ind_contact_birthday'

    ];

    protected $fillable = [    'ind_contact_name' , 'ind_contact_phone' , 'ind_contact_email' ,
        'name_retail_point_ukr', 'name_retail_point_en', 'ind_contact_name', 'category_description',
        'ind_fio', 'ind_inn', 'ind_birthday', 'ind_phone', 'ind_email', 'ind_main_rate',
        'ind_single_tax_rate','personType',
        'ur_retail_name_ukr', 'ur_retail_name_en', 'ur_city', 'ur_address',
        'ur_region', 'ur_fio', 'ur_inn', 'ur_birthday', 'ur_phone', 'ur_email', 'ur_contact_fio',
        'ur_contact_phone', 'ur_contact_email', 'ur_actual_business_address', 'ur_actual_business_city',
        'ur_actual_business_region', 'ur_actual_business_index', 'ur_type', 'ur_data_controllers', 'ur_buh_fio',
        'ur_buh_phone', 'ur_buh_email'
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