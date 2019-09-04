<?php


namespace App\Http\Controllers;


use App\Classes\Filters\ExecuteFilter;
use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\LogMerchantRequestsRepository;
use App\Classes\LogicalModels\ReportsRepository;
use App\Exceptions\NotFoundException;
use App\Models\MerchantPaymentRoute;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReportsController extends Controller
{

    public $reports;
    public $request;

    public function __construct(Request $request, ReportsRepository $reportsRepository)
    {
        $this->request = $request;
        $this->reports = $reportsRepository;
    }

    public function index()
    {
        return view('reports.index');
    }

    public function list()
    {
        return view('reports.manage.index')->with(['queriesReport' => $this->reports->list()]);
    }

    public function store()
    {
        $validator = Validator::make($this->request->all(), [
            'query' => 'required|string',
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $reports = new Reports();
                $reports->fill($this->request->all());
                $this->reports->save($reports);

                return ApiResponse::goodResponseSimple($reports);
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }

    public function remove()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer|exists:reports,id'
        ]);

        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $report = $this->reports->getOne($this->request->get('id'));
                $this->reports->remove($report);

                return ApiResponse::goodResponseSimple($report);
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }

    public function update()
    {
        $validator = Validator::make($this->request->all(), [
            'query' => 'required|string',
            'name' => 'required|string',
            'id' => 'required|integer|exists:reports,id'
        ]);

        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $report = $this->reports->getOne($this->request->get('id'));
                $report->fill($this->request->all());
                $this->reports->save($report);

                return ApiResponse::goodResponseSimple($report);
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }

    public function execute()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer|exists:reports,id',
            'variables' => 'nullable'
        ]);

        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $report = $this->reports->getOne($this->request->get('id'));
                $data = $this->reports->execute($report,  (!is_null($this->request->get('variables')))?$this->request->get('variables'):null );

                return ApiResponse::goodResponseSimple($data);
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }
}
