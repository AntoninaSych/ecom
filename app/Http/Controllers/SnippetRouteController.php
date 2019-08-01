<?php


namespace App\Http\Controllers;


use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\CardSystemRepository;
use App\Classes\LogicalModels\PaymentRoutesRepository;
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

    public function index()
    {
        $merchantPaymentRoutes = $this->routesRepository->list()->pluck('name', 'id');
        $cardSystem = $this->cardSystemRepository->getList();

        return view('merchants.payment-route.snippets.index')->with([
            'cardSystem' => $cardSystem,
            'merchantPaymentRoutes' => $merchantPaymentRoutes

        ]);
    }

    public function table()
    {
        $snippetList = $this->snippetRepository->list();

        return view('merchants.payment-route.snippets.snippet-list')->with([
            'snippetList' => $snippetList
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
            'final' => 'integer|required'
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
            'id'=> 'required|integer|exists:snippet_merchant_route,id',
            'payment_route_id' => 'required|integer|exists:payment_routes,id',
            'sum_min' => 'required|integer',
            'sum_max' => 'required|integer',
            'card_system' => 'required|integer|exists:cards_systems,id',
            'bins' => 'string|nullable',
            'priority' => 'integer|nullable',
            'final' => 'integer|required'
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