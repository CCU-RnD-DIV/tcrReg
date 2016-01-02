<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ResetCheck extends Request
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
            'pid' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '請填寫您的電子郵件帳號',
            'email.email' => '請填寫正確的E-Mail格式',
            'pid.required' => '請填寫身分證字號'
        ];
    }
}
