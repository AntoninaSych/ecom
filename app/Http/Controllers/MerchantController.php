<?php


namespace App\Http\Controllers;


use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\MerchantsRepository;
use App\Exceptions\NoDataFoundException;
use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MerchantController extends Controller
{
    public $merchants;
    public $request;

    public function __construct(MerchantsRepository $merchantsRepository, Request $request)
    {
        $this->merchants = $merchantsRepository;
        $this->request = $request;
    }

    public function getlistByName()
    {

         $validator = Validator::make($this->request->all(), [
            'name' => 'required|string'
        ]);


        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $name = $this->request->get('name');
                return ApiResponse::goodResponseSimple($this->merchants->getOneByName($name));
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }

    }
}