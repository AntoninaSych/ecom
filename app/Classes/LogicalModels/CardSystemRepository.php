<?php


namespace App\Classes\LogicalModels;


use App\Models\CardSystems;

class CardSystemRepository
{
    public function getList()
    {
        return CardSystems::all()->pluck('name', 'id');
    }
}