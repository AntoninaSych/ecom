<?php


namespace App\Classes\LogicalModels;


use App\Models\MerchantsUserAlias;
use App\Models\MerchantUser;
use Illuminate\Support\Facades\DB;

class MerchantUserAliasRepository
{
    public $alias;
    public $user;

    public function __construct(MerchantsUserAlias $alias, MerchantUser $user)
    {
        $this->alias = $alias;
        $this->user = $user;
    }

    public function getOne($id)
    {
        $alias = $query = $this->alias::select()
            ->select('*')
            ->where('id', '=', $id)
            ->first();

        return $alias;
    }

    public function getList($merchantId)
    {
        $list = new MerchantsUserAlias();
        $list = $list::select()->where('merchant_id', $merchantId)->get();

        return $list;
    }

    public function users($userName, $assignedUsers)
    {
        $list = $this->user::select('id', 'username');

        if (!is_null($assignedUsers)) {
            $list = $list->whereNotIn('id', $assignedUsers);
        }

        if (!is_null($userName)) {
            $list = $list->where('username', 'like', '%' . $userName . '%');
        }
        $list = $list->limit(10)
            ->get();

        return $list;
    }


    public function storeAlias($userId, $roleId, $merchantId): void
    {
        $alias = $query = $this->alias::select()
            ->where('user_id', '=', $userId)
            ->where('merchant_id', '=', $merchantId)
            ->first();

        if (!is_null($alias)) {
            $alias->role_id = intval($roleId);


        } else {
            $alias = new MerchantsUserAlias();
            $alias->merchant_id = $merchantId;
            $alias->role_id = $roleId;
            $alias->user_id = $userId;

        }
        $alias->save();
    }

    public function updateAlias($id, $userId, $roleId, $merchantId): void
    {
        $alias = $query = $this->alias::select()
            ->select('*')
            ->where('id', '=', $id)
            ->first();

        if (!is_null($alias)) {
            $alias->role_id = $roleId;
            $alias->user_id = $userId;
            $alias->merchant_id = $merchantId;
            $alias->save();
        }
    }

    public function removeAlias(MerchantsUserAlias $alias): void
    {
        if (!is_null($alias)) {
            $alias->delete();
        }
    }

   public function getMerchants($userId)
{
    $list = new MerchantsUserAlias();
    $list = $list::select()->where('user_id', $userId)->get();

    return $list;
}

}