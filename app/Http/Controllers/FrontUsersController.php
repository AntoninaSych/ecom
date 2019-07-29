<?php


namespace App\Http\Controllers;


use App\Classes\LogicalModels\MerchantUserRepository;

class FrontUsersController
{
    protected $users;
    protected $merchantUserAlias;

    public function __construct(MerchantUserRepository $frontUsers)
    {
        $this->users = $frontUsers;
    }

    public function index()
    {
        $codes = $this->users->list();
        $this->merchantUserAlias->getMerchants();
        return view('mcc.index')->with(['codes' => $codes]);
    }

    public function show()
    {

    }

}