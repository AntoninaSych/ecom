<?php


namespace App\Http\Controllers;


use App\Classes\Filters\SearchPaymentsFilter;
use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\CallBackRepository;
use App\Classes\LogicalModels\MerchantsRepository;
use App\Exceptions\NoDataFoundException;
use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

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

    public function list()
    {
        return view('merchants.view');
    }

    public function getOneById(int $id)
    {
        $merchant = $this->merchants->getOneById($id);

        return view('merchants.detailed')->with([
            'merchant' => $merchant
        ]);
    }

    public function anyData()
    {
        $merchants = $this->merchants->getList();
        return Datatables::of($merchants)
            ->addColumn('id', function ($merchants) {
                return $merchants->id;
            })
            ->addColumn('merchant_id', function ($merchants) {
                return $merchants->merchant_id;
            })
            ->editColumn('name', function ($merchants) {
                return $merchants->name;
            })
            ->editColumn('url', function ($merchants) {
                return $merchants->url;
            })
            ->editColumn('status', function ($merchants) {
                return $merchants->getRelations()['status']->name;
            })
            ->addColumn('view_details', function ($merchants) {
                return '<a class="btn btn-black" href="'.route('merchant.detail',['id'=>$merchants->id]).'"><i class="fa fa-fw fa-eye"></i></a>';
            })
            ->rawColumns(['view_details'])
            ->make(true);
    }
}