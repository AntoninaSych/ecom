<?php


namespace App\Classes\LogicalModels;

use App\Models\SnippetMerchant;

class SnippetMerchantRepository
{
    public function getNames()
    {
        $nameList = new SnippetMerchant();
        $nameList = $nameList->select()->get();

        return $nameList;
    }

    public function getOne($id)
    {
        $nameList = new SnippetMerchant();
        $snippetName = $nameList->select()->where('id', $id)->first();

        return $snippetName;
    }

    public function save(SnippetMerchant $snippet)
    {
        $snippet->save();
    }

    public function remove(SnippetMerchant $snippet)
    {
        $snippet->delete();
    }
}