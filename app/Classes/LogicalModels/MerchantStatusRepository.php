<?php


namespace App\Classes\LogicalModels;


use App\Exceptions\NotFoundException;
use App\Models\MerchantStatus;

class MerchantStatusRepository
{
    protected $statuses;

    public function __construct(MerchantStatus $statuses)
    {
        $this->statuses = $statuses;
    }

    public function getListMerchantStatuses()
    {
        return $this->statuses->select()->get();
    }

    public function getOne(int $id)
    {
        $status = $this->statuses->where('id',$id)->first();
        if(is_null($status))
        {
            throw new NotFoundException('Статус с указанным ID не найден');
        }

        return $status;
    }


}