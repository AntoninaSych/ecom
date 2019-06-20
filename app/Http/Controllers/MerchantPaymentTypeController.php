<?php


namespace App\Http\Controllers;

use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\LogMerchantRequestsRepository;
use App\Exceptions\NotFoundException;
use App\Models\MerchantPaymentTypes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Classes\LogicalModels\MerchantPaymentTypeRepository;
use App\Models\RefFeeType;
use App\Models\RefPaymentType;
use Illuminate\Http\Request;

class MerchantPaymentTypeController
{
    public $merchantPaymentTypes;
    public $request;

    public function __construct(MerchantPaymentTypeRepository $merchantPaymentTypes, Request $request)
    {
        $this->merchantPaymentTypes = $merchantPaymentTypes;
        $this->request = $request;
    }

    public function getTable($merchantId)
    {

        $refPaymentTypes = RefPaymentType::all(['name', 'id']);
        $merchantPaymentTypes = $this->merchantPaymentTypes->list($merchantId);
        $alreadyUsedtypes = $merchantPaymentTypes->pluck('payment_type')->all();

        $filtered = $refPaymentTypes->except($alreadyUsedtypes)->all();
        $allowedPaymentTypes = [];
        for ($i = 0; $i < count($filtered); $i++) {
            $allowedPaymentTypes[$filtered[$i]->id] = $filtered[$i]->name;
        }
        $refFeeTypes = RefFeeType::all(['name', 'id'])->pluck('name', 'id');

        return view('merchants.payment-type.merchant-payment-type-list')->with([
            'merchantPaymentTypes' => $merchantPaymentTypes,
            'refPaymentTypes' => $allowedPaymentTypes,
            'refFeeTypes' => $refFeeTypes,
            'merchantId' => $merchantId
        ]);
    }

    public function store()
    {
        $validator = Validator::make($this->request->all(), [
            'payment_type' => 'required|integer|exists:ref_payment_types,id',
            'fee_proc' => 'required|numeric|between:0,99.99',
            'fee_fix' => 'required|numeric|between:0,99.99',
            'fee_type' => 'required|integer|exists:ref_fee_type,id',
            'merchant_id' => 'required|integer|exists:merchants,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $merchantPaymentTypes = new MerchantPaymentTypes();
                $merchantPaymentTypes->fill($this->request->all());
               $this->merchantPaymentTypes->save($merchantPaymentTypes);
                LogMerchantRequestsRepository::log(
                    $this->request->get('merchant_id'),
                    $this->request,
                    [  'action' => 'store merchant payment type',
                        'user' => Auth::user()->getAuthIdentifier(),
                        'status'=>'Успешное добавление payment type для мерчанта'
                    ]);
                return ApiResponse::goodResponseSimple($this->merchantPaymentTypes);
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }

    public function update()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer|exists:merchant_pament_types',
            'payment_type' => 'required|integer|exists:ref_payment_types,id',
            'fee_proc' => 'required|numeric|between:0,99.99',
            'fee_fix' => 'required|numeric|between:0,99.99',
            'fee_type' => 'required|integer|exists:ref_fee_type,id',
            'merchant_id' => 'required|integer|exists:merchants,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $merchantPaymentTypes = $this->merchantPaymentTypes->getOne($this->request->get('id'));
                $merchantPaymentTypes->fill($this->request->all());
                $this->merchantPaymentTypes->save($merchantPaymentTypes);
                LogMerchantRequestsRepository::log(
                    $this->request->get('merchant_id'),
                    $this->request,
                    [  'action' => 'store merchant payment type',
                        'user' => Auth::user()->getAuthIdentifier(),
                        'status'=>'Успешное изменение payment type для мерчанта'
                    ]);
                return ApiResponse::goodResponseSimple($this->merchantPaymentTypes);
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }


}