<?php


namespace App\Models;

use Zizaco\Entrust\EntrustRole;


class Role extends EntrustRole
{
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

//    public function userRole()
//    {
//        return $this->hasMany(Role::class, 'user_id', 'id');
//    }
//
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
}