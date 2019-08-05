<?php


namespace App\Classes\LogicalModels;


use App\Exceptions\NotFoundException;
use App\Models\SnippetMerchantRoute;


class SnippetMerchantRouteRepository
{

    public function save(SnippetMerchantRoute $snippetMerchantRoute)
    {
        $snippetMerchantRoute->save();
    }

    public function list($snippetId)
    {
        $snippet = new SnippetMerchantRoute();
        return $snippet->select()->where('snippet_id', $snippetId)->get();
    }

    public function getOne($id)
    {
        $snippet = new SnippetMerchantRoute();
        $code = $snippet->select()->where('id', $id)->first();

        if (is_null($code)) {
            throw new NotFoundException('Шаблон не найден по данному ID');
        }

        return $code;
    }

    public function remove(SnippetMerchantRoute $snippetMerchantRoute)
    {

        $snippetMerchantRoute->delete();
    }


}