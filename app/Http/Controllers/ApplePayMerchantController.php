<?php


namespace App\Http\Controllers;


use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\ApplePaySettingsRepository;
use App\Exceptions\NotFoundException;
use App\Models\ApplePaySettings;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplePayMerchantController extends Controller
{
    public $applePay;
    public $request;

    public function __construct(ApplePaySettingsRepository $repository,
                                Request $request)
    {
        $this->applePay = $repository;
        $this->request = $request;
    }

    public function index($merchant_id)
    {
        $applePayList = $this->applePay->getByMerchantId($merchant_id);

        return view('merchants.apple-pay.list')
            ->with(['applePayList' => $applePayList,
                'merchantId' => $merchant_id]);
    }

    public function show()
    {

    }

    public function update()
    {
        $validator = Validator::make($this->request->all(), [
            'merchant_identifier' => 'required|string',
            'domain_name' => 'required|string',
            'merchant_id' => 'required|integer',
            'id' => 'required|integer|exists:apple_pay_settings,id'
        ]);

        if ($validator->fails()) {

            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {

            $applePay = $this->applePay->getOne($this->request->get('id'));

            $applePay->fill($this->request->all());
            try {
                $this->applePay->save($applePay);
            } catch (QueryException $exception) {
                return ApiResponse::badResponseValidation(['Ошибка сохранения']);
            }
        }
    }

    public function store()
    {
        $validator = Validator::make($this->request->all(), [
            'merchant_identifier' => 'required|string',
            'domain_name' => 'required|string',
            'merchant_id' => 'required|integer|exists:merchants,id'
        ]);

        if ($validator->fails()) {

            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {

            $applePay = new ApplePaySettings();

            $applePay->fill($this->request->all());
            try {
                $this->applePay->save($applePay);
            } catch (QueryException $exception) {
                return ApiResponse::badResponseValidation(['Ошибка сохранения']);
            }
        }
    }

    public function remove()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer|exists:apple_pay_settings,id'
        ]);

        if ($validator->fails()) {

            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            $applePay = $this->applePay->getOne($this->request->get('id'));
            try {
                $this->applePay->remove($applePay);
            } catch (QueryException $exception) {
                return ApiResponse::badResponseValidation(['Ошибка сохранения']);
            }
        }
    }
}