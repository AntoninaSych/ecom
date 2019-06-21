<?php

namespace App\Http\Controllers;

use App\Classes\LogicalModels\LogMerchantRequestsRepository;
use App\Classes\LogicalModels\MerchantAccountRepository;
use App\Http\Requests\Merchant\CreateAccount;
use App\Http\Requests\Merchant\UpdateAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        LogMerchantRequestsRepository::log( $request->get('merchant_id'), $request,[  'action' => 'update', 'user' => Auth::user(), 'status'=>'Изменение аккаунта мерчанта.']);
        $accounts = $this->accounts->getList($request->get('merchant_id'));
        return redirect()->back()->with(['success' => 'Аккаунт успешно изменен.', 'accountsNew' => $accounts]);
    }


    public function store(CreateAccount $request)
    {
        $this->accounts->save($request);
        LogMerchantRequestsRepository::log( $request->get('merchant_id'), $request,[  'action' => 'store', 'user' => Auth::user(), 'status'=>'Добавление аккаунта мерчанта.']);
        $accounts = $this->accounts->getList($request->get('merchant_id'));
        return redirect()->back()->with(['success' => 'Аккаунт успешно добавлен.', 'accountsNew' => $accounts]);
    }

    public function destroy(Request $request)
    {
        $merchantId = $this->accounts->getOne($request->get('id_account'))->merchant->id;
        LogMerchantRequestsRepository::log( $request->get('merchant_id'), $request,[  'action' => 'destroy', 'user' => Auth::user(), 'status'=>'Удаление аккаунта мерчанта.']);
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