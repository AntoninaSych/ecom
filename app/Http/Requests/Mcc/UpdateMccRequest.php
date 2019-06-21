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
            'mcc_name' => 'required|string|max:100',
            'mcc_name_uk' => 'required|string|max:100',
            'mcc_name_en' => 'required|string|max:100',
            'mcc_description' => 'required|string|max:200',
            'mcc_apple_pay' => 'required|integer|max:1',
            'mcc_code' => 'required|string|max:4',
            'mcc_hight_risk' => 'required|integer|max:1',
        ];
    }


}
