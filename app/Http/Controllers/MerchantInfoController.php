<?php


namespace App\Http\Controllers;


use App\Classes\LogicalModels\OrderRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MerchantInfoController
{
    public $request;
    public $orders;

    public function __construct(Request $request,
                                OrderRepository $orderRepository)
    {
        $this->request = $request;
        $this->orders = $orderRepository;
    }


    public function index()
    {
        $orders = $this->orders->list();

        return view('merchants.info.query-list')->with(['orders'=>$orders]);
    }

    public function show(int $id)
    {
        $order = $this->orders->getOne($id);
        $fieldValues = $this->orders->getFieldValues($order->id);

        return view('merchants.info.query-details')->with(['order'=>$order,'fieldValues'=>$fieldValues]);
    }


}