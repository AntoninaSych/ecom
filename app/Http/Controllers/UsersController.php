<?php


namespace App\Http\Controllers;


use App\Classes\Helpers\ApiResponse;
use App\Classes\LogicalModels\RoleRepository;
use App\Classes\LogicalModels\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public $users;
    public $roles;
    public $request;


    public function __construct(UsersRepository $usersRepository,
                                RoleRepository $roleRepository,
                                Request $request)
    {
        $this->users = $usersRepository;
        $this->roles = $roleRepository;
        $this->request = $request;
    }

    public function getList()
    {
        $users = $this->users->getList();
        $roles = $this->roles->allRoles();

      return view('users.list')->with(['users' => $users, 'roles' => $roles]);
    }

    public function applyRole()
    {
        $roleId = $this->request->get('role_id');
        $userId = $this->request->get('user_id');
        $this->users->applyRole($roleId, $userId);

        $users = $this->users->getList();
        return ApiResponse::goodResponse(['users'=>$users]);
    }
}