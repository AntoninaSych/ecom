<?php


namespace App\Classes\LogicalModels;


use App\Exceptions\NotFoundException;
use App\Http\Requests\Merchant\UpdateMerchant;
use App\Models\MccCodes;
use App\Models\Merchants;
use App\Models\MerchantStatus;
use App\Models\MerchantUser;
use App\User;
use mysql_xdevapi\Collection;

class MccCodeRepository
{
    protected $codes;

    public function __construct(MccCodes $codes)
    {
        $this->codes = $codes;

    }

    public function getList()
    {
        return $this->codes->get();
    }

    public function getOne($id)
    {
        $code = $this->codes->select()->where('id', $id)->first();

        if (is_null($code)) {
            throw new NotFoundException('Mcc code не найден по данному ID');
        }

        return $code;
    }

    public function destroy($id):void
    {
        $this->getOne($id)->delete();
    }

    public function update($request, $id): void
    {
        $code = $this->getOne($id);

        $code->name = $request->get('mcc_name');
        $code->code = $request->get('mcc_code');
        $code->apple_pay = $request->get('mcc_apple_pay');
        $code->save();
    }

    public function store($request)
    {
        $code = new MccCodes();
        $code->name = $request->get('mcc_name');
        $code->code = $request->get('mcc_code');
        $code->apple_pay = $request->get('mcc_apple_pay');
        $code->save();

    }

}