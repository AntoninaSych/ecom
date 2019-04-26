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

    /**
     * @param null $limit
     * @return mixed
     */
    public function getList($limit = null)
    {
        if (!is_null($limit)) {
            return $collection = $this->merchants->select()->limit($limit)->get();
        }
        return   Merchants::with('status:id,name')->get();
    }

    public function getOneById(int $id){
        return $this->merchants->findOrFail($id);
    }
}