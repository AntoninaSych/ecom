<?php


namespace App\Http\Requests\Merchant;


use App\Classes\Helpers\PermissionHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccount extends  FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can(PermissionHelper::MANAGE_MERCHANT);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'merchant_id' =>  'required|integer|exists:ref_merchant_statuses,id',
            'id_account'=> 'required|integer|exists:merchant_account,id',
            'payment_account' => 'required|string|regex:(^\d+(\.\d+)*$)|max:25',
            'edrpo_code' => 'required|string|max:25',
            'mfo_code' => 'required|string|max:25'
        ];
    }

}