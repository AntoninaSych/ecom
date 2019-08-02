<?php


namespace App\Http\Controllers;


use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\CardSystemRepository;
use App\Classes\LogicalModels\PaymentRoutesRepository;
use App\Classes\LogicalModels\SnippetMerchantRepository;
use App\Classes\LogicalModels\SnippetMerchantRouteRepository;
use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use App\Models\SnippetMerchantRoute;
use Illuminate\Support\Facades\Validator;
use Throwable;

class SnippetRouteController extends Controller
{
    public $snippetRepository;
    public $request;
    protected $cardSystemRepository;
    protected $routesRepository;

    public function __construct(SnippetMerchantRouteRepository $repository,
                                Request $request,
                                CardSystemRepository $cardSystemRepository,
                                PaymentRoutesRepository $routesRepository
    )
    {
        $this->snippetRepository = $repository;
        $this->request = $request;
        $this->cardSystemRepository = $cardSystemRepository;
        $this->routesRepository = $routesRepository;
    }

    public function index($id)
    {
        $cardSystem = $this->cardSystemRepository->getList();
        $snippetList = $this->snippetRepository->list($id);
        $merchantPaymentRoutes = $this->routesRepository->list()->pluck('name', 'id');
        return view('merchants.snippets.routes.index')->with([
            'cardSystem' => $cardSystem,
            'snippetList' => $snippetList,
            'merchantPaymentRoutes' => $merchantPaymentRoutes,
            'snippetId' => $id
        ]);
    }


    public function store()
    {
        $validator = Validator::make($this->request->all(), [
            'payment_route_id' => 'required|integer|exists:payment_routes,id',
            'sum_min' => 'required|integer',
            'sum_max' => 'required|integer',
            'card_system' => 'required|integer|exists:cards_systems,id',
            'bins' => 'string|nullable',
            'priority' => 'integer|nullable',
            'final' => 'integer|required',
            'snippet_id' => 'required|integer|exists:snippets_merchant,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $snippetRoute = new SnippetMerchantRoute();
                $snippetRoute->fill($this->request->all());
                $this->snippetRepository->save($snippetRoute);
            } catch (Throwable $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }

    public function remove()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer|exists:snippet_merchant_route,id'
        ]);
        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $snippetRoute = $this->snippetRepository->getOne($this->request->get('id'));
                $this->snippetRepository->remove($snippetRoute);
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }


    public function update()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer|exists:snippet_merchant_route,id',
            'payment_route_id' => 'required|integer|exists:payment_routes,id',
            'sum_min' => 'required|integer',
            'sum_max' => 'required|integer',
            'card_system' => 'required|integer|exists:cards_systems,id',
            'bins' => 'string|nullable',
            'priority' => 'integer|nullable',
            'final' => 'integer|required',
            'snippet_id' => 'required|integer|exists:snippets_merchant,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $snippetRoute = $this->snippetRepository->getOne($this->request->get('id'));
                $snippetRoute->fill($this->request->all());
                $this->snippetRepository->save($snippetRoute);
            } catch (Throwable $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }


}