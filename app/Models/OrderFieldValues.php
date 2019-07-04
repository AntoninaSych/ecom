<?php


namespace App\Models;



class OrderFieldValues extends BaseModel
{
    protected $table = 'order_fields_values';

    protected $with = ['field'];

    public function field()
    {
        return $this->hasOne(OrderField::class, 'id','field_id');
    }


}