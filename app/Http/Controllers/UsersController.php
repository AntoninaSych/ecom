<?php


namespace App\Http\Controllers;


use App\Classes\LogicalModels\UsersRepository;

class UsersController extends Controller
{
    public $users;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->users = $usersRepository;
    }

    public function getList()
    {
        $users = $this->users->getList();

        return view('users.list')->with(['users' => $users]);
    }
}