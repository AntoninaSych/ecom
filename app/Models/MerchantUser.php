<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantUser extends Model
{
    //this user comes from dispatcher front

    protected $table = 'user';
    public $timestamps =false;

    protected $hidden = ['auth_key', 'password_hash', 'password_reset_token', 'created_at'];


}
