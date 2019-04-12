<?php


namespace App\Classes\LogicalModels;


use App\Exceptions\NotFoundException;
use App\Models\Merchants;

class MerchantsRepository
{
    protected $merchants;

    public function __construct(Merchants $merchants)
    {
        $this->merchants = $merchants;
    }

    public function getOneByName(string $merchantName)
    {
        $merchants = Merchants::select()->where('name', 'LIKE', '%' . $merchantName . '%')->limit(4)->get();
        if (empty($merchants->toArray())) {
            throw new NotFoundException("Мерчанты не найдены.");
        }
        return $merchants;
    }

    public function getListLimited()
    {
        return $this->merchants->select()->limit(3)->get();
    }
}