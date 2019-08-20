<?php


namespace App\Classes\LogicalModels;


use App\Classes\Filters\MerchantSearchFilter;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Merchant\CreateMerchant;
use App\Http\Requests\Merchant\UpdateMerchant;
use App\Models\MccCodes;
use App\Models\MerchantInfo;
use App\Models\MerchantKeys;
use App\Models\Merchants;
use App\Models\MerchantStatus;
use App\Models\MerchantsUserAlias;
use App\Models\MerchantUser;
use Illuminate\Support\Facades\DB;


class MerchantsRepository
{
    protected $merchants;
    protected $merchantStatus;
    protected $merchantKeys;
    protected $merchantUser;
    protected $merchantInfo;
    protected $mccCode;

    public function __construct(Merchants $merchants,
                                MerchantStatus $merchantStatus,
                                MerchantKeys $merchantKeys,
                                MerchantsUserAlias $merchantUser,
                                MerchantInfo $merchantInfo,
                                MccCodes $mccCode)
    {
        $this->merchants = $merchants;
        $this->merchantStatus = $merchantStatus;
        $this->merchantKeys = $merchantKeys;
        $this->merchantUser = $merchantUser;
        $this->merchantInfo = $merchantInfo;
        $this->mccCode = $mccCode;
    }

    public function getQuickSearch(array $params)
    {
        $merchants = Merchants::select();

        if (!is_null($params['name'])) {
            $merchants = $merchants->where('name', 'LIKE', '%' . $params['name'] . '%');
        }
        $merchants = $merchants->limit(10)->get();
        if (empty($merchants->toArray())) {
            throw new NotFoundException("Мерчанты не найдены.");
        }
        return $merchants;
    }


    public function getDeepSearch(MerchantSearchFilter $filter)
    {
        $query = DB::table($this->merchants->getTable() . ' as merchants')
            ->select(
                'merchants.id',
                'merchants.merchant_id',
                'merchants.name',
                'merchants.mcc_id',
                'merchants.url',
                'merchants_status.name as status',
                'terminal.key_types',
                'terminal.merchant_login as terminalId',
                'merchant_info.personType as type',
                'merchants_mcc.code as code' ,
                'merchants_mcc.name as mcc_name'

            )
            ->leftjoin($this->merchantStatus->getTable() . ' as merchants_status', 'merchants.status', '=', 'merchants_status.id')
            ->leftjoin($this->merchantKeys->getTable() . ' as terminal', 'merchants.id', '=', 'terminal.merchant_id')
            ->leftjoin($this->merchantUser->getTable() . ' as merchants_users', 'merchants.id', '=', 'merchants_users.merchant_id')
            ->leftjoin($this->mccCode->getTable() . ' as merchants_mcc', 'merchants.mcc_id', '=', 'merchants_mcc.id')
            ->leftjoin($this->merchantInfo->getTable(), 'merchants.id', '=', 'merchant_info.merchant_id');
        $query = $query->where('terminal.key_types', '=', 5);

        if (!is_null($filter->terminal)) {
            $query = $query->where('terminal.merchant_login', $filter->terminal);
        }
        if (!is_null($filter->merchant_id)) {
            $query = $query->where('merchants.id', $filter->merchant_id);
        }
        if (!is_null($filter->merchant_creator_user)) {
            $query = $query->where('merchants.user_id', $filter->merchant_creator_user);
        }
        if (!is_null($filter->identifier)) {
            $query = $query->where('merchants.id', $filter->identifier);
        }
        if (!is_null($filter->concordpay_user)) {
            $query = $query->where('merchants_users.user_id', $filter->concordpay_user);
        }
        $query = $query->groupBy('merchants.id');
        if (!is_null($filter->order)) {
            $query = $query->orderBy($filter->order[0]['column'], $filter->order[0]['dir']);
        }

        return $query;
    }

    /**
     * @param null $limit
     * @return mixed
     */
    public function getList($limit = null)
    {
        if (!is_null($limit)) {
            return $collection = $this->merchants->select()->limit($limit)->get();
        }
        return Merchants::with('status:id,name')->get();
    }

    public function getListForDatatable($limit = null)
    {
        if (!is_null($limit)) {
            return $collection = $this->merchants->select()->limit($limit);
        }
        return Merchants::with('merchant_status:id,name');
    }


    public function getOneById(int $id)
    {
        $merchant = $this->merchants->findOrFail($id);
        if (is_null($merchant)) {
            throw new NotFoundException('Мерчант с данным ID не существует');
        }

        return $merchant;
    }

    public function getListMerchantStatuses()
    {
        $statuses = new MerchantStatus();

        return $statuses->select()->get();
    }

    public function updateOverall(UpdateMerchant $request, $id): void
    {
        $merchant = $this->getOneById($id);
        $merchant->merchant_id = $request->get('merchant_identifier');
        $merchant->name = $request->get('merchant_name');
        $merchant->url = $request->get('merchant_url');
        $merchant->status = $request->get('merchant_status');
        if ($request->get('mcc_id') == 0) {
            $merchant->mcc_id = null;
        } else {
            $merchant->mcc_id = $request->get('mcc_id');
        }

        $merchant->save();
    }


    public function store(CreateMerchant $request)
    {
        $merchant = new Merchants();
        $merchant->merchant_id = 'BO_' . substr(md5(mt_rand()), 10, 15);
        $merchant->name = $request->get('merchant_name');
        $merchant->url = $request->get('merchant_url');
        $merchant->status = $request->get('merchant_status');
        $merchant->apple_merchant_id = '';
        if ($request->get('mcc_id') == 0) {
            $merchant->mcc_id = null;
        } else {
            $merchant->mcc_id = $request->get('mcc_id');
        }
        $merchant->user_id = $request->get('user_id');
        $merchant->save();
        return $merchant;
    }

    public function updateStatus(Merchants $merchant, int $status)
    {
        $merchant->status = $status;
        $merchant->save();
    }

    public function getMerchantsIdentifier($merchantId = null)
    {
        $merchant = new Merchants();
        $query = $merchant->select();
        if (!is_null($merchantId)) {
            $query = $query->where('merchants.merchant_id', 'like', '%' . $merchantId . '%');
        }

        return $query->limit(10)->get();
    }

    public function getByterminalId($merchantId = null)
    {
        $merchant = new Merchants();
        $query = $merchant->select();
        if (!is_null($merchantId)) {
            $query = $query->where('merchants.merchant_id', 'like', '%' . $merchantId . '%');
        }

        return $query->limit(10)->get();
    }
}