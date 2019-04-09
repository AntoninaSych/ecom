<?php


namespace App\Http\Controllers\Payments;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function search()
    {

        return view('payments.search');
    }

    public function payments()
    {

        return view('payments.payments');
    }
}