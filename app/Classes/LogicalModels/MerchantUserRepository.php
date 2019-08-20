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
        return $this->user->select('*')->get();
    }

    public function getSearch(array $params)
    {
        $query =  $this->user->select();

        if(!is_null($params['username']))
        {
          $query= $query->where('username','like','%'.$params['username']."%");
        }

        return $query->limit(10)->get();
    }



}