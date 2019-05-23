<?php

namespace App\Http\Requests\Merchant;

use App\Classes\Helpers\PermissionHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMerchant extends FormRequest
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
            'mcc_id' =>'nullable|integer',
            'merchant_identifier' => 'required|string|max:50',
            'merchant_name' => 'required|string|max:50',
            'merchant_url' => 'nullable|string|max:50',
            'merchant_status' => 'required|integer|exists:ref_merchant_statuses,id',
            'merchant_user_name' => 'required|string|max:50',
            'merchant_user_email' => 'email|max:50',
        ];
    }


}
