<?php


namespace App\Http\Controllers;


use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\LogMerchantRequestsRepository;
use App\Classes\LogicalModels\MerchantUserAliasRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MerchantUserAliasController
{
    public $merchantUserAlias;
    public $request;

    public function __construct(MerchantUserAliasRepository $repository,
                                Request $request)
    {
        $this->merchantUserAlias = $repository;
        $this->request = $request;
    }

    public function getTable($id)
    {
        $merchantUserAlias = $this->merchantUserAlias->getList($id);


        return view('merchants.merchant-user-alias.merchant-user-alias-list')->with([
            'merchantUserAlias' => $merchantUserAlias,
            'merchantId' => $id
        ]);
    }

    public function getMerchantsUserAlias()
    {

        $merchantUserAlias = $this->merchantUserAlias->getList($this->request->get('merchant_id'));
        $assignedUsers = array_map(function ($item) {
            return $item['user_id'];
        }, $merchantUserAlias->toArray());

        $alias = $this->merchantUserAlias->users(
            $this->request->get('name'),
            $assignedUsers)->pluck('username', 'id');

        return $alias;
    }

    public function store()
    {
        $validator = Validator::make($this->request->all(), [
            'user_id' => 'required|array',
            'merchant_id' => 'required|integer',
            'role_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            LogMerchantRequestsRepository::log(
                $this->request->get('merchant_id'),
                $this->request,
                [
                    'action' => 'MerchantUserAliasController/store',
                    'user' => Auth::user()->getAuthIdentifier(),
                    'status' => 'Неуспешная попытка добавить связь пользователе'
                ]);

            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {

            foreach ($this->request->get('user_id') as $userId) {
                try {
                    $this->merchantUserAlias->storeAlias(
                        $userId,
                        $this->request->get('role_id'),
                        $this->request->get('merchant_id')
                    );
                } catch (\Throwable $e) {

                    LogMerchantRequestsRepository::log(
                        $this->request->get('merchant_id'),
                        $this->request,
                        [
                            'action' => 'Store access for users concordPay to merchants',
                            'user' => Auth::user()->getAuthIdentifier(),
                            'status' => 'Неуспешная попытка добавить связь пользователе'
                        ]);
                }
            }
        }


        LogMerchantRequestsRepository::log(
            $this->request->get('merchant_id'),
            $this->request,
            [
                'action' => 'MerchantUserAliasController/store',
                'user' => Auth::user()->getAuthIdentifier(),
                'status' => 'Успешная попытка добавить связь пользователе'
            ]);


        return $this->getTable($this->request->get('merchant_id'));
    }

    public function update()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer|exists:users_merchants,id',
            'user_id' => 'required|integer',
            'merchant_id' => 'required|integer',
            'role_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            LogMerchantRequestsRepository::log(
                $this->request->get('merchant_id'),
                $this->request,
                [
                    'action' => 'MerchantUserAliasController/store',
                    'user' => Auth::user()->getAuthIdentifier(),
                    'status' => 'Неуспешная попытка добавить связь пользователе'
                ]);

            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $this->merchantUserAlias->updateAlias(
                    $this->request->get('id'),
                    $this->request->get('user_id'),
                    $this->request->get('role_id'),
                    $this->request->get('merchant_id')
                );
            } catch (\Throwable $e) {

                LogMerchantRequestsRepository::log(
                    $this->request->get('merchant_id'),
                    $this->request,
                    [
                        'action' => 'Store access for users concordPay to merchants',
                        'user' => Auth::user()->getAuthIdentifier(),
                        'status' => 'Неуспешная попытка добавить связь пользователе'
                    ]);
            }
        }


        LogMerchantRequestsRepository::log(
            $this->request->get('merchant_id'),
            $this->request,
            [
                'action' => 'MerchantUserAliasController/store',
                'user' => Auth::user()->getAuthIdentifier(),
                'status' => 'Успешная попытка добавить связь пользователе'
            ]);


        return $this->getTable($this->request->get('merchant_id'));
    }

    public function remove()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer|exists:users_merchants,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        }
        $merchantAlias = $this->merchantUserAlias->getOne($this->request->get('id'));
        $this->merchantUserAlias->removeAlias($merchantAlias);

    }
}