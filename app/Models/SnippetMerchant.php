<?php


namespace App\Models;


class SnippetMerchant extends BaseModel
{
    public $table = 'snippets_merchant';
    protected $fillable = ['name'];
    public $timestamps = false;
}