<?php


namespace App\Models;

use Zizaco\Entrust\EntrustRole;


class Reports extends BaseModel
{
    protected $table = 'reports';
    protected $fillable = [
        'name',
        'query'
    ];
}
