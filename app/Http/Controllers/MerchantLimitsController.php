<?php


namespace App\Http\Controllers;


use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\CardSystemRepository;
use App\Classes\LogicalModels\LogMerchantRequestsRepository;
use App\Classes\LogicalModels\MerchantLimitsRepository;
use App\Exceptions\NotFoundException;
use App\Models\MerchantPaymentLimits;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MerchantLimitsController
{
    protected $merchantLimits;
    protected $request;
    protected $cardSystemRepository;

    public function __construct(MerchantLimitsRepository $merchantLimits,
                                Request $request,
                                CardSystemRepository $cardSystemRepository
    )
    {
        $this->merchantLimits = $merchantLimits;
        $this->request = $request;
        $this->cardSystemRepository = $cardSystemRepository;
    }

    public function getTable()
    {
        $limits = $this->merchantLimits->getList($this->request['merchantId']);
        $cardSystem = $this->cardSystemRepository->getList();
        $allowedLimitType = $this->merchantLimits->getLimitTypes();

        return view('merchants.payment-limits.payment-limit-list')->with([
            'limits' => $limits,
            'cardSystem' => $cardSystem,
            'allowedLimitType' => $allowedLimitType,
            'merchantId' => $this->request['merchantId']
        ]);
    }

    public function update()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer|exists:merchant_limits,id',
            'amount' => 'required|integer',
            'card_system' => 'required|integer|exists:cards_systems,id',
            'merchant_id' => 'required|integer|exists:merchants,id',
            'limit_types' => 'required|integer|exists:ref_limit_types,id',
        ]);

        if ($validator->fails()) {
            LogMerchantRequestsRepository::log(
                $this->request->get('merchant_id'),
                $this->request,
                ['action' => 'update limit fail',
                    'user' => Auth::user()->getAuthIdentifier(),
                    'status' => 'Неуспешная попытка добавить новый лимит'
                ]);

            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $MerchantPaymentLimit = $this->merchantLimits->getOne($this->request->get('id'));
                $MerchantPaymentLimit->fill($this->request->all());
                try {
                $this->merchantLimits->save($MerchantPaymentLimit);
                } catch (QueryException $exception)
                {
                    return ApiResponse::badResponseValidation(['Тип карты с типом лимита уже существуют']);
                }
                LogMerchantRequestsRepository::log(
                    $this->request->get('merchant_id'),
                    $this->request,
                    ['action' => 'update success',
                        'user' => Auth::user()->getAuthIdentifier(),
                        'status' => 'Лимит платежей успешно изменен'
                    ]);
                return ApiResponse::goodResponseSimple($this->merchantLimits);
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }

    public function store()
    {

        $validator = Validator::make($this->request->all(), [
            'amount' => 'required|integer',
            'card_system' => 'required|integer|exists:cards_systems,id',
            'merchant_id' => 'required|integer|exists:merchants,id',
            'limit_types' => 'required|integer|exists:ref_limit_types,id',
        ]);

        if ($validator->fails()) {
            LogMerchantRequestsRepository::log(
                $this->request->get('merchant_id'),
                $this->request,
                ['action' => 'store limit fail',
                    'user' => Auth::user()->getAuthIdentifier(),
                    'status' => 'Неуспешная попытка добавить новый лимит'
                ]);

            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $merchantPaymentLimits = new MerchantPaymentLimits();
                $merchantPaymentLimits->fill($this->request->all());
                try {
                    $this->merchantLimits->save($merchantPaymentLimits);
                } catch (QueryException $exception)
                {
                    return ApiResponse::badResponseValidation(['Тип карты с типом лимита уже существуют']);
                }
                LogMerchantRequestsRepository::log(
                    $this->request->get('merchant_id'),
                    $this->request,
                    ['action' => 'store limit success',
                        'user' => Auth::user()->getAuthIdentifier(),
                        'status' => 'Лимит успешно добавлен'
                    ]);
                return ApiResponse::goodResponseSimple($this->merchantLimits);
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }

}