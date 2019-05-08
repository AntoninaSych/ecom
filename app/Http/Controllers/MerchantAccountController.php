<?php

namespace App\Http\Controllers;

use App\Classes\LogicalModels\MerchantAccountRepository;
use App\Http\Requests\Merchant\CreateAccount;
use App\Http\Requests\Merchant\UpdateAccount;
use Illuminate\Http\Request;


class MerchantAccountController
{
    protected $accounts;

    public function __construct(MerchantAccountRepository $repository)
    {
        $this->accounts = $repository;
    }

    public function update(UpdateAccount $request)
    {
        $this->accounts->update($request);
        $accounts = $this->accounts->getList($request->get('merchant_id'));
        return redirect()->back()->with(['success' => 'Аккаунт успешно изменен.', 'accountsNew' => $accounts]);
    }

    public function store(CreateAccount $request, int $merchantId)
    {
        $this->accounts->save($request, $merchantId);
        $accounts = $this->accounts->getList($merchantId);
        return redirect()->back()->with(['success' => 'Аккаунт успешно добавлен.', 'accountsNew' => $accounts]);
    }

    public function destroy(Request $request)
    {

        $merchantId = $this->accounts->getOne($request->get('id_account'))->merchant->id;
        $accounts = $this->accounts->getList($merchantId);
        $this->accounts->destroy($request->get('id_account'));

        return redirect()->back()->with(['success' => 'Аккаунт успешно удален.', 'accountsNew' => $accounts]);

    }

    public function getList($merchantId)
    {
        $accounts = $this->accounts->getList($merchantId);
        return view('merchants.account-list')->with(['accounts' => $accounts]);
    }
}