<?php


namespace App\Models;


use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role',
            'permission_id',
            'role_id');
    }
}