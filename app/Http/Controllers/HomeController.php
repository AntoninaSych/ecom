<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\Entrust;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

   //$admins =  Auth::user()->hasRole('admin');
  // $admins = Auth::user()->can('manage-users');

        return view('home');
    }
}
