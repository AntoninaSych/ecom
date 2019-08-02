<?php


namespace App\Http\Controllers;


use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\SnippetMerchantRepository;
use App\Exceptions\NotFoundException;
use App\Models\SnippetMerchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class SnippetController extends Controller
{
    public $snippetRepository;
    public $request;

    public function __construct(SnippetMerchantRepository $snippetMerchant,
                                Request $request)
    {
        $this->snippetRepository = $snippetMerchant;
        $this->request = $request;

    }

    public function index()
    {
        $merchantSnippetNames = $this->snippetRepository->getNames();

        return view('merchants.snippets.index')->with([
            'merchantSnippetNames' => $merchantSnippetNames
        ]);
    }

    public function update()
    {
        $validator = Validator::make($this->request->all(), [
            'name' => 'string|max:50|required',
            'snippet_id' => 'required|integer|exists:snippets_merchant,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $snippetRoute = $this->snippetRepository->getOne($this->request->get('snippet_id'));
                $snippetRoute->name = $this->request->get('name');


                $this->snippetRepository->save($snippetRoute);
            } catch (Throwable $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }

    public function store()
    {
        $validator = Validator::make($this->request->all(), [
            'name' => 'string|max:50|required',
        ]);

        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $snippetRoute = new SnippetMerchant();
                $snippetRoute->name = $this->request->get('name');
                $this->snippetRepository->save($snippetRoute);
            } catch (Throwable $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }
    }

    public function remove()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer|exists:snippets_merchant,id'
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
}