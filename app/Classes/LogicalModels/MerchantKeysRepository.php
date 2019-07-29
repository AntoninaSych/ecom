<?php


namespace App\Classes\LogicalModels;


use App\Models\MerchantKeys;

class MerchantKeysRepository
{

    public $keys;

    public function __construct(MerchantKeys $keys)
    {
        $this->keys = $keys;

    }


    public function getGeneratedKeyByMerchantId($id)
    {
        return $this->keys->select()->where('merchant_id', $id)->where('key_types', 5)->first();

    }

}