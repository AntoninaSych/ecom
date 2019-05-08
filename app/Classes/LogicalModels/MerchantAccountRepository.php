<?php


namespace App\Classes\LogicalModels;


use App\Exceptions\NotFoundException;
use App\Http\Requests\Merchant\CreateAccount;
use App\Http\Requests\Merchant\UpdateAccount;
use App\Models\MerchantAccount;

class MerchantAccountRepository
{
    protected $accounts;
    protected $merchants;

    public function __construct(MerchantAccount $accounts, MerchantsRepository $merchantsRepository)
    {
        $this->accounts = $accounts;
        $this->merchants = $merchantsRepository;
    }

    public function save(CreateAccount $request)
    {
        $merchant = $this->merchants->getOneById($request->get('merchant_id'));
        $account = new MerchantAccount();
        $account->mfo = $request->get('mfo_code');
        $account->ed_rpo = $request->get('edrpo_code');
        $account->checking_account = $request->get('payment_account');
        $account->merchant_id = $merchant->id;
        $account->save();
    }

    public function getList(int $idMerchant)
    {
        return $this->accounts->select()->where('merchant_id', $idMerchant)->get();
    }

    public function getOne(int $idAccount)
    {
        $account = $this->accounts->select()->where('id',$idAccount)->first();
        if (is_null($account)) {
            throw new NotFoundException('Аккаунта с данным ID не существует');
        }
        return $account;
    }

    public function destroy($idAccount): void
    {
        $account = $this->getOne($idAccount);
        $account->delete();
    }

    public function update(UpdateAccount $request)
    {
       $account =  $this->getOne($request->get('id_account'));

        $account->mfo = $request->get('mfo_code');
        $account->ed_rpo = $request->get('edrpo_code');
        $account->checking_account = $request->get('payment_account');
        $account->save();
    }
}