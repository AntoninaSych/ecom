<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password_current'=> 'required|min:5',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5',
        ];
    }
}
