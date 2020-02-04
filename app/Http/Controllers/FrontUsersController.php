<?php


namespace App\Http\Controllers;

use App\Classes\Filters\FrontUserFilter;
use App\Classes\LogicalModels\MerchantUserAliasRepository;
use App\Classes\LogicalModels\MerchantUserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MerchantUser;
use Yajra\DataTables\Facades\DataTables;


class FrontUsersController
{
    protected $users;
    protected $merchantUserAlias;
    protected $request;

    /**
     * FrontUsersController constructor.
     * @param MerchantUserRepository $frontUsers
     * @param MerchantUserAliasRepository $merchantUserAlias
     * @param Request $request
     */
    public function __construct(MerchantUserRepository $frontUsers,
                                MerchantUserAliasRepository $merchantUserAlias,
                                Request $request)
    {
        $this->users = $frontUsers;
        $this->merchantUserAlias = $merchantUserAlias;
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = MerchantUser::with(['utm'])->paginate(20);
        return view('front-users.index')->with(['users' => $list]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $merchants = $this->merchantUserAlias->getMerchants($id);

        return view('front-users.show')->with(['merchants' => $merchants]);
    }

    public function anyData()
    {
        $users = $this->users->getDeepSearch(FrontUserFilter::create($this->request->all()));

        return Datatables::query($users)
            ->addColumn('id', function ($user) {
                return $user->id;
            })
            ->editColumn('username', function ($user) {
                return $user->username;
            })
            ->editColumn('email', function ($user) {
                return   $user->email ;
            })
            ->editColumn('created_at', function ($user) {
                return   Carbon::createFromFormat('U', $user->created_at)->format('d-m-Y')   ;
            })
            ->editColumn('utm_term', function ($user) {
                return   $user->utm_term ;
            })
            ->editColumn('utm_content', function ($user) {
                return   $user->utm_content ;
            })
            ->editColumn('utm_campaign', function ($user) {
                return   $user->utm_campaign ;
            })
            ->editColumn('utm_medium', function ($user) {
                return   $user->utm_medium ;
            })
            ->editColumn('utm_source', function ($user) {
                return   $user->utm_source ;
            })
            ->editColumn('active_merchants', function ($user) {
                return   $user->active_merchants ;
            })
            ->editColumn('total_merchants', function ($user) {
                return   $user->total_merchants ;
            })
            ->make(true);
    }

    public function exportToCSV()
   {
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=" . date(DATE_ATOM) . ".csv");
        echo "\xEF\xBB\xBF";
        header("Pragma: no-cache");
        header("Expires: 0");
        $fp = fopen('php://output', 'w');
        $val = ['Id', 'Имя пользователя', 'Email', 'created_at', 'utm_term', 'utm_content', 'utm_campaign', 'utm_medium',
            'utm_source', 'active_merchants', 'total_merchants'];

        fputcsv($fp, $val, ';');
        foreach ($this->users->getDeepSearch(FrontUserFilter::create($this->request->all()))->get() as $model) {

            $val = [
                $model->id,
                $model->username,
                $model->email,
                Carbon::createFromFormat('U', $model->created_at)->format('d-m-Y')  ,
                $model->utm_term,
                $model->utm_content,
                $model->utm_campaign,
                $model->utm_medium,
                $model->utm_source,
                $model->active_merchants,
                $model->total_merchants];
            fputcsv($fp, $val, ';');
        }

        fclose($fp);
        return null;
    }
}
