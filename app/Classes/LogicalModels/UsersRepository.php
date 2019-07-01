<?php


namespace App\Classes\LogicalModels;


use App\Models\Role;
use App\Models\Users;
use Illuminate\Support\Collection;


class UsersRepository
{

    public $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function getList(): Collection
    {
        return $this->users->with('roles_relation')->orderBy('id','desc')->get();
    }

    public function applyRole(int $role_id, int $user_id): void
    {
        $newRole = Role::where('id', '=', $role_id)->first();
        $user = $this->users->where('id', '=', $user_id)->first();
        $user->roles_relation()->detach();
        $user->roles_relation()->attach($newRole);
    }

    public function updateStatus($user_id, $status)
    {
        $user = $this->users->findOrFail($user_id);
        $user->status = intval($status);
        $user->save();
    }

    public function getOne($key,$value)
    {
        return $this->users->select()->where($key ,'=', $value)->first();
    }

}

