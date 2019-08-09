<?php


namespace App\Http\Controllers;


use App\Classes\LogicalModels\MerchantUserAliasRepository;
use App\Classes\LogicalModels\MerchantUserRepository;
use App\Models\MerchantUser;


class FrontUsersController
{
    protected $users;
    protected $merchantUserAlias;

    public function __construct(MerchantUserRepository $frontUsers,
                                MerchantUserAliasRepository $merchantUserAlias)
    {
        $this->users = $frontUsers;
        $this->merchantUserAlias = $merchantUserAlias;
    }

    public function index()
    {
      $list = MerchantUser::paginate(20);
        return view('front-users.index')->with(['users'=>$list]) ;
    }

    public function show($id)
    {
        $merchants = $this->merchantUserAlias->getMerchants($id);

        return view('front-users.show')->with(['merchants' => $merchants]);
    }
}