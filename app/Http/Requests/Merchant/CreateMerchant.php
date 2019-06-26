<?php

namespace App\Http\Requests\Merchant;

use App\Classes\Helpers\PermissionHelper;
use Illuminate\Foundation\Http\FormRequest;

class CreateMerchant extends FormRequest
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
            'user_id' =>'integer',
            'terminal_id' => 'sometimes:integer',
            'merchant_name' => 'required|string|max:50',
            'merchant_url' => 'nullable|url',
            'merchant_status' => 'required|integer|exists:ref_merchant_statuses,id',
        ];
    }


}
