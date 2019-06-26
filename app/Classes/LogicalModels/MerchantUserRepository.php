<?php


namespace App\Classes\LogicalModels;


use App\Models\MerchantUser;

class MerchantUserRepository
{
    public $users;

    public function __construct(MerchantUser $users)
    {
        $this->user = $users;
    }

    public function list()
    {
        return $this->user->select('id','username')->get();
    }


}