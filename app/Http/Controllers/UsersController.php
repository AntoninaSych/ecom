<?php


namespace App\Http\Controllers;


use App\Classes\Filters\SearchPaymentsFilter;
use App\Classes\Helpers\ApiResponse;
use App\Classes\LogicalModels\RoleRepository;
use App\Classes\LogicalModels\UsersRepository;
use App\Models\Users;
use Couchbase\Exception;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    use SendsPasswordResetEmails;

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
        return ApiResponse::goodResponse(['users' => $users]);
    }

    public function statusUpdate()
    {
        $id = $this->request->get('id');
        $status = $this->request->get('status');
        $this->users->updateStatus($id, $status);
        $users = $this->users->getList();


        return ApiResponse::goodResponse(['users' => $users]);
    }

    public function sendLink($id)
    {

        try{
        $user = $this->users->getOne('id', $id);

        $request = new Request($user->toArray());

        $this->sendResetLinkEmail($request);

        return ApiResponse::goodResponse();
        }
        catch (\Exception $exception)
        {
            return ApiResponse::badResponse();

        }
    }


}