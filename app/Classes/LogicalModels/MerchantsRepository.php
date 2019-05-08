<?php


namespace App\Classes\LogicalModels;


use App\Exceptions\NotFoundException;
use App\Http\Requests\Merchant\UpdateMerchant;
use App\Models\Merchants;
use App\Models\MerchantStatus;
use App\Models\MerchantUser;
use App\User;
use mysql_xdevapi\Collection;

class MerchantsRepository
{
    protected $merchants;

    public function __construct(Merchants $merchants )
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
        return Merchants::with('status:id,name')->get();
    }

    public function getOneById(int $id)
    {
        $merchant = $this->merchants->findOrFail($id);
        if (is_null($merchant)) {
            throw new NotFoundException('Мерчант с данным ID не существует');
        }

        return $merchant;
    }

    public function getListMerchantStatuses()
    {
        $statuses = new MerchantStatus();

        return $statuses->select()->get();
    }

    public function updateOverall(UpdateMerchant $request, $id):void
    {
        $merchant  = $this->getOneById($id);
        $merchant->merchant_id = $request->get('merchant_identifier');
        $merchant->name = $request->get('merchant_name');
        $merchant->url = $request->get('merchant_url');
        $merchant->status = $request->get('merchant_status');
        if ($request->get('mcc_id')==0){
            $merchant->mcc_id = null;
        }else{ $merchant->mcc_id = $request->get('mcc_id');}
        $user = new MerchantUser();
        $user =  $user->findOrFail($merchant->user->id);

        $user->email = $request->get('merchant_user_email');

        $user->username = $request->get('merchant_user_name');

        $user->save();
        $merchant->save();
    }
}