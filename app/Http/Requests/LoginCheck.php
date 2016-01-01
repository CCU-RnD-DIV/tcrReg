<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginCheck extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
    }

    public function  messages()
    {
        return [
            'email.required' => '請填寫您的電子郵件帳號',
            'email.email' => '請確認您的電子郵件帳號格式是否正確',
            'password.required' => '請填寫您的密碼',
            'password.min' => '密碼最少8個字元'
        ];
    }
}
