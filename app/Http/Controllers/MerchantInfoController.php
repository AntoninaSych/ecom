<?php


namespace App\Http\Controllers;


use App\Classes\Helpers\RoleHelper;
use App\Classes\LogicalModels\OrderRepository;
use App\Exceptions\PermissionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return view('merchants.info.query-list')->with(['orders' => $orders]);
    }

    public function anyData()
    {
       // $orders = $this->orders->list();

    }

    public function show(int $id)
    {
        $order = $this->orders->getOne($id);
        $fieldValues = $this->orders->getFieldValues($order->id);

        return view('merchants.info.query-details')->with(['order' => $order, 'fieldValues' => $fieldValues]);
    }

    //todo Log
    public function assign(): void
    {
        $user = Auth::user();

        $order = $this->orders->getOne($this->request->get('order_id'));
        if (is_null($order->assign)) {
            $this->orders->assign($order, $user);
        } else {
            throw new PermissionException('Пользователь уже назначен к заказу');
        }
    }

    //todo Log
    public function apply()
    {
        $user = Auth::user();
        $comment = $this->request->get('comment');
        $order = $this->orders->getOne($this->request->get('order_id'));

            if ($user->hasRole(RoleHelper::FRAUD_MONITORING)) {
                $order->fraud_check = $user->id;
                $order->fraud_comment = $comment;
            }
            if ($user->hasRole(RoleHelper::SECURITY)) {
                $order->security_check = $user->id;
                $order->security_comment = $comment;
            }
            if ($user->hasRole(RoleHelper::BUSINESS)) {
                $order->business_check = $user->id;
                $order->business_comment = $comment;
            }
        if ($this->request->get('type') === 'decline') {
            $order->decline_user_id = $user->id;
            $order->decline_comment = $comment;
        }
        $order->assigned = null;
        $order->save();

        $order = $this->orders->getOne($this->request->get('order_id'));
        $fieldValues = $this->orders->getFieldValues($order->id);

        return view('merchants.info.query-details')->with(['order' => $order, 'fieldValues' => $fieldValues]);

    }



}