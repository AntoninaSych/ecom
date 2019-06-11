<?php


namespace App\Http\Controllers;


use App\Classes\Helpers\ApiResponse;
use App\Classes\LogicalModels\LogMerchantRequestsRepository;
use App\Classes\LogicalModels\MerchantPaymentRouteRepository;
use App\Classes\LogicalModels\MerchantPaymentTypeRepository;
use App\Classes\LogicalModels\PaymentRoutesRepository;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\CardSystems;
use App\Models\MerchantPaymentRoute;
use App\Classes\Helpers\ValidatorHelper;
use Illuminate\Http\Request;


class MerchantRoutesController
{
    protected $merchantPaymentRoutes;
    protected $request;
    protected $merchantPaymentTypes;
    protected $paymentRoutes;

    public function __construct(MerchantPaymentRouteRepository $repository,
                                Request $request,
                                MerchantPaymentTypeRepository $merchantPaymentTypes,
                                PaymentRoutesRepository $paymentRoutesRepository

    )
    {
        $this->request = $request;
        $this->merchantPaymentRoutes = $repository;
        $this->merchantPaymentTypes = $merchantPaymentTypes;
        $this->paymentRoutes = $paymentRoutesRepository;
    }

    public function getTable()
    {
        $merchantId = $this->request->get('merchantId');
        $merchantPaymentTypes = $this->merchantPaymentTypes->list($merchantId);
        $paymentRoutes = $this->paymentRoutes->list()->pluck('payment_type')->unique()->toArray();

        $paymentRotesForCurrentMerchant = $merchantPaymentTypes->map(function ($item) use ($paymentRoutes) {
            if (in_array($item->payment->id, $paymentRoutes)) {
                return ['key' => $item->payment->id, 'value' => $item->payment->name . "(" . $item->payment->code . ")"];
            }
        })->filter()->all();
        $cardSystem = CardSystems::all()->pluck('name', 'id');

        $merchantPaymentRoutes = $this->merchantPaymentRoutes->list($merchantId);
        return view('merchants.payment-route.merchant-payment-route-list')->with([
            'merchantPaymentRoutes' => $merchantPaymentRoutes,
            'merchantPaymentTypes' => $paymentRotesForCurrentMerchant,
            'merchantId' => $merchantId,
            'cardSystem' => $cardSystem
        ]);
    }

    public function getAllowedRoutes(int $paymentTypeId)
    {
        $allowedRoutes = $this->paymentRoutes->getByPaymentType($paymentTypeId)->pluck('name', 'id');
        return ApiResponse::goodResponse($allowedRoutes);
    }

    public function store()
    {

        $validator = Validator::make($this->request->all(), [
            'payment_route_id' => 'required|integer|exists:payment_routes,id',
            'sum_min' => 'required|numeric',
            'sum_max' => 'required|numeric',
            'card_system'=> 'required|integer|exists:cards_systems,id',
            'merchant_id' => 'required|integer|exists:merchants,id',
        ]);

        if ($validator->fails()) {
            LogMerchantRequestsRepository::log(
                $this->request->get('merchant_id'),
                $this->request,
                [  'action' => 'store fail',
                    'user' => Auth::user()->getAuthIdentifier(),
                    'status'=>'Неуспешная попытка добавить новый роут'
                ]);

            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $MerchantPaymentRoute = new MerchantPaymentRoute();
                $MerchantPaymentRoute->fill($this->request->all());
                $this->merchantPaymentRoutes->save($MerchantPaymentRoute);
                LogMerchantRequestsRepository::log(
                    $this->request->get('merchant_id'),
                    $this->request,
                    [  'action' => 'store success',
                        'user' => Auth::user()->getAuthIdentifier(),
                        'status'=>'Роут успешно добавлен'
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
            'id' => 'required|integer|exists:merchant_routes,id',
            'payment_route_id' => 'required|integer|exists:payment_routes,id',
            'sum_min' => 'required|numeric',
            'sum_max' => 'required|numeric',
            'card_system'=> 'required|integer|exists:cards_systems,id',
            'merchant_id' => 'required|integer|exists:merchants,id',
        ]);

        if ($validator->fails()) {
            LogMerchantRequestsRepository::log(
                $this->request->get('merchant_id'),
                $this->request,
                [  'action' => 'update fail',
                    'user' => Auth::user()->getAuthIdentifier(),
                    'status'=>'Неуспешная попытка добавить новый роут'
                ]);

            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $MerchantPaymentRoute = $this->merchantPaymentRoutes->getOne($this->request->get('id')) ;
                $MerchantPaymentRoute->fill($this->request->all());
                $this->merchantPaymentRoutes->save($MerchantPaymentRoute);
                LogMerchantRequestsRepository::log(
                    $this->request->get('merchant_id'),
                    $this->request,
                    [  'action' => 'store success',
                        'user' => Auth::user()->getAuthIdentifier(),
                        'status'=>'Роут успешно изменен'
                    ]);
                return ApiResponse::goodResponseSimple($this->merchantPaymentTypes);
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }

}