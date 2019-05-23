<?php

namespace App\Http\Requests\Mcc;

use App\Classes\Helpers\PermissionHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMccRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can(PermissionHelper::MANAGE_MCC);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mcc_name' => 'required|string|max:20',
            'mcc_apple_pay' => 'required|integer|max:1',
            'mcc_code' => 'required|required|integer'
        ];
    }


}
