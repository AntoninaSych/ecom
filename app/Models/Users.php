<?php


namespace App\Models;


class Users extends BaseModel
{
    protected $table = 'users';

    public function roles()
    {
        return $this->hasManyThrough(Role::class,
            RoleUser::class,
            'user_id',
            'id',
            'id',
            'role_id')
            ->select('display_name');
    }



}
