<?php


namespace App\Classes\LogicalModels;


use App\Exceptions\NotFoundException;
use App\Models\SnippetMerchantRoute;

class SnippetMerchantRouteRepository
{
    public $snippet;

    public function __construct(SnippetMerchantRoute $merchantRoutes)
    {
        $this->snippet = $merchantRoutes;
    }

    public function save(SnippetMerchantRoute $snippetMerchantRoute)
    {
        $snippetMerchantRoute->save();
    }

    public function list()
    {
        return $this->snippet->select()->get();
    }

    public function getOne($id)
    {
        $code = $this->snippet->select()->where('id', $id)->first();

        if (is_null($code)) {
            throw new NotFoundException('Шаблон не найден по данному ID');
        }

        return $code;
    }

    public function remove(SnippetMerchantRoute $snippetMerchantRoute){
        $snippetMerchantRoute->delete();
    }
}