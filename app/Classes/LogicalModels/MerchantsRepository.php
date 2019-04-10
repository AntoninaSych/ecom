<?php


namespace App\Classes\LogicalModels;



use App\Models\Merchants;

class MerchantsRepository
{
    protected $merchants;

    public function __construct(Merchants $merchants)
    {
        $this->merchants = $merchants;
    }

    public function getList()
    {
       return $this->merchants->get();
    }

    public function getListLimited()
    {
        return $this->merchants->select()->limit(10)->get();
    }
}