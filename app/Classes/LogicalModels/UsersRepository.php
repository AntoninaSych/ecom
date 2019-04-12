<?php


namespace App\Classes\LogicalModels;


use App\Models\Users;

class UsersRepository
{

    public $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function getList()
    {
        return $this->users->select()->get();
    }

}