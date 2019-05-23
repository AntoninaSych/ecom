<?php


namespace App\Http\Controllers;


use App\Classes\Filters\SearchPaymentsFilter;
use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\CallBackRepository;
use App\Classes\LogicalModels\MccCodeRepository;
use App\Classes\LogicalModels\MerchantsRepository;
use App\Classes\LogicalModels\MerchantStatusRepository;
use App\Exceptions\NoDataFoundException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Merchant\UpdateMerchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MerchantController extends Controller
{
    public $merchants;
    public $request;
    public $statuses;
    public $codes;

    public function __construct(MerchantsRepository $merchantsRepository,
                                Request $request,
                                MerchantStatusRepository $statuses, MccCodeRepository $codes)
    {
        $this->merchants = $merchantsRepository;
        $this->request = $request;
        $this->statuses = $statuses;
        $this->codes = $codes;
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
        $arrayMerchantStatuses = $this->statuses->getListMerchantStatuses()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });

        $mcc_codes = $this->codes->getList()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });


        return view('merchants.detailed')->with([
            'merchant' => $merchant,
            'arrayMerchantStatuses' => $arrayMerchantStatuses,
            'codes'=>$mcc_codes
        ]);
    }

    public function update(UpdateMerchant $updateMerchant, int $id)
    {
        $this->merchants->updateOverall($updateMerchant, $id);

        return redirect()->back()->with('success', 'Мерчант  с ID  ' . $id . ' успешно обновлен.');

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

                return '<a class="btn btn-black" href="' . $merchants->url . '">' . $merchants->url . '</a>';

            })
            ->editColumn('status', function ($merchants) {
                return $merchants->getRelations()['status']->name;
            })
            ->addColumn('view_details', function ($merchants) {
                return '<a class="btn btn-black" href="' . route('merchant.detail', ['id' => $merchants->id]) . '"><i class="fa fa-fw fa-eye"></i></a>';
            })
            ->rawColumns(['view_details', 'url'])
            ->make(true);
    }



}