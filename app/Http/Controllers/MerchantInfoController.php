<?php


namespace App\Http\Controllers;


use App\Classes\Filters\SearchMerchantRequestsFilter;
use App\Classes\Filters\SearchPaymentsFilter;
use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\MerchantStatusHelper;
use App\Classes\Helpers\RoleHelper;
use App\Classes\LogicalModels\MerchantInfoRepository;
use App\Classes\LogicalModels\MerchantsRepository;
use App\Classes\LogicalModels\OrderRepository;
use App\Exceptions\PermissionException;
use App\Models\MerchantStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MerchantInfoController
{
    public $request;
    public $orders;
    public $merchantInfo;
    public $merchant;

    public function __construct(Request $request,
                                OrderRepository $orderRepository,
                                MerchantInfoRepository $merchantInfoRepository,
                                MerchantsRepository $merchantsRepository
    )
    {
        $this->request = $request;
        $this->orders = $orderRepository;
        $this->merchantInfo = $merchantInfoRepository;
        $this->merchant = $merchantsRepository;
    }


    public function index()
    {
        $orders = $this->orders->list(SearchMerchantRequestsFilter::create($this->request->all()));

        return view('merchants.info.query-list')->with(['orders' => $orders]);
    }

    /**
     * for Datatables
     */
    public function anyData()
    {
        $orders = $this->orders->list(SearchMerchantRequestsFilter::create($this->request->all()));
        return Datatables::of($orders)
            ->addColumn('id', function ($orders) {
                return $orders->id;
            })
            ->editColumn('created_at', function ($order) {
                return $order->created_at;
            })
            ->editColumn('marchant_state', function ($order) {
                return $order->status->name;
            })
            ->editColumn('order_state', function ($order) {
                if (!is_null($order->decline_user_id)) {
                    return "Отклонена сотрудником:" . $order->declineUser->name;
                }
                if (!is_null($order->assigned)) {
                    return " В работе у сотрудника:" . $order->assignedUser->name;
                }
                if (is_null($order->decline_user_id) && is_null($order->assigned) && is_null($order->business_check)) {
                    return "В очереди на обработку";
                }
                return 'Закрыта';
            })
            ->editColumn('merchant', function ($order) {
                return $order->merchant->name;
            })
            ->editColumn('user_created', function ($order) {
                return $order->user->username;
            })
            ->editColumn('fraud', function ($order) {
                return (!is_null($order->fraudUser)) ? $order->fraudUser->name : '';
            })
            ->editColumn('security', function ($order) {
                return (!is_null($order->securityUser)) ? $order->securityUser->name : '';
            })
            ->editColumn('business', function ($order) {
                return (!is_null($order->businessUser)) ? $order->businessUser->name : '';
            })
            ->addColumn('view_details', function ($order) {

                return '<a href="/queries/' . $order->id . '"><i class="fa fa-fw fa-eye"></i> </a>';
            })
            ->rawColumns(['view_details', 'order_state'])
            ->make(true);


    }


    public function show(int $id)
    {
        $order = $this->orders->getOne($id);
        $fieldValues = $this->orders->getFieldValues($order->id);

        return view('merchants.info.query-details')->with(['order' => $order, 'fieldValues' => $fieldValues]);
    }

//todo Log
    public function assign()
    {
        $user = Auth::user();

        $order = $this->orders->getOne($this->request->get('order_id'));
        if (is_null($order->assigned)) {
            $this->orders->assign($order, $user);
            return ApiResponse::goodResponse('Пользователь успешно назначен к заказу');

        }
        return ApiResponse::badResponse('Пользователь уже назначен к заказу', 500);


    }

//todo Log
    public function apply()
    {
        $user = Auth::user();
        $comment = $this->request->get('comment');
        $order = $this->orders->getOne($this->request->get('order_id'));

        if ($user->getAuthIdentifier() !== $order->assigned) {
            throw new PermissionException('Данная заявка была закреплена ранее за другим сотрудником.');
        }

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
        if ($this->request->get('type') === 'apply' && $user->hasRole(RoleHelper::BUSINESS)) {
            $this->merchantInfo->save($order);
            $merchant = $this->merchant->getOneById($order->merchant_id);
            $this->merchant->updateStatus($merchant,MerchantStatus::ACTIVE_STATUS );

        }
        $order->assigned = null;
        $order->save();

        $order = $this->orders->getOne($this->request->get('order_id'));
        $fieldValues = $this->orders->getFieldValues($order->id);

        return view('merchants.info.query-details')->with(['order' => $order, 'fieldValues' => $fieldValues]);

    }


    public function archive()
    {
        $orders = $this->orders->archive();

        return view('merchants.info.query-archive')->with(['orders' => $orders]);
    }

    public function archiveData()
    {
        $orders = $this->orders->archive();
        return Datatables::of($orders)
            ->addColumn('id', function ($orders) {
                return $orders->id;
            })
            ->editColumn('created_at', function ($order) {
                return $order->created_at;
            })
            ->editColumn('marchant_state', function ($order) {
                return $order->status->name;
            })
            ->editColumn('order_state', function ($order) {
                if (!is_null($order->decline_user_id)) {
                    return "Отклонена сотрудником:" . $order->declineUser->name;
                }
                if (!is_null($order->assigned)) {
                    return " В работе у сотрудника:" . $order->assignedUser->name;
                }
                if (is_null($order->decline_user_id) && is_null($order->assigned) && is_null($order->business_check)) {
                    return "В очереди на обработку";
                }
                return 'Закрыта';
            })
            ->editColumn('merchant', function ($order) {
                return $order->merchant->name;
            })
            ->editColumn('user_created', function ($order) {
                return $order->user->username;
            })
            ->editColumn('fraud', function ($order) {
                return (!is_null($order->fraudUser)) ? $order->fraudUser->name : '';
            })
            ->editColumn('security', function ($order) {
                return (!is_null($order->securityUser)) ? $order->securityUser->name : '';
            })
            ->editColumn('business', function ($order) {
                return (!is_null($order->businessUser)) ? $order->businessUser->name : '';
            })
            ->addColumn('view_details', function ($order) {
                return '<a href="/queries/' . $order->id . '"><i class="fa fa-fw fa-eye"></i> </a>';
            })
            ->rawColumns(['view_details', 'order_state'])
            ->make(true);
    }
}