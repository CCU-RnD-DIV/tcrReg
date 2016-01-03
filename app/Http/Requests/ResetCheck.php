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
            'pid' => 'required',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '請填寫您的電子郵件帳號',
            'email.email' => '請填寫正確的E-Mail格式',
            'pid.required' => '請填寫身分證字號',
            'g-recaptcha-response.required' => '您必須進行驗證才能繼續',
            'g-recaptcha-response.recaptcha' => '您必須驗證成功才能繼續'
        ];
    }
}
