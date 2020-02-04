<?php


namespace App\Classes\LogicalModels;


use App\Classes\Filters\FrontUserFilter;
use App\Models\Merchants;
use App\Models\MerchantUser;
use App\Models\Utm;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class MerchantUserRepository
 * @package App\Classes\LogicalModels
 */
class MerchantUserRepository
{
    public $users;
    public $utm;
    public $merchants;

    public function __construct(MerchantUser $users, Utm $utm, Merchants $merchants)
    {
        $this->user = $users;
        $this->utm = $utm;
        $this->merchants = $merchants;
    }

    public function list()
    {
        return $this->user->select('*')->get();
    }

    public function getSearch(array $params)
    {
        $query = $this->user->select();

        if (!is_null($params['username'])) {
            $query = $query->where('username', 'like', '%' . $params['username'] . "%");
        }

        return $query->limit(10)->get();
    }

    public function getDeepSearch(FrontUserFilter $filter)
    {
        $sub = Merchants::where(['merchants.status'=>3])->count(); // Eloquent Builder instance
        $query = DB::table($this->user->getTable() . ' as users')
            ->select(
                'users.id',
                'users.username',
                'users.email',
                'users.created_at',
                'utm.utm_term',
                'utm.utm_content',
                'utm.utm_campaign',
                'utm.utm_medium',
                'utm.utm_source'
            )
            ->selectSub(' select COUNT(merchants.id) from merchants where merchants.user_id = users.id and merchants.status = 3  ',
                'active_merchants' )
            ->selectSub(' select COUNT(merchants.id) from merchants where merchants.user_id = users.id   ',
                'total_merchants' )
            ->leftJoin($this->utm->getTable() . ' as utm', 'utm.user_id', '=', 'users.id') ;

         if ($filter->created_from != "" && $filter->created_to != "") {
            $start_date = Carbon::createFromFormat('d-m-Y', $filter->created_from)->startOfDay()->format('U');
            $end_date = Carbon::createFromFormat('d-m-Y', $filter->created_to)->endOfDay()->format('U');

        } else {
            $start_date = Carbon::now()->startOfDay()->format('U');

            $end_date = Carbon::now()->endOfDay()->format('U');
        }

       $query = $query->whereBetween('users.created_at', [$start_date, $end_date]);

        return $query;
    }


}
