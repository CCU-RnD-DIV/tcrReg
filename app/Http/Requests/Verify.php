<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Verify extends Request
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
            'verify' => 'required|min:6',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }

    public function messages()
    {
        return [
            'verify.required' => '請填寫欄位',
            'verify.min' => '欄位最少為六個字',
            'g-recaptcha-response.required' => '您必須進行驗證才能繼續',
            'g-recaptcha-response.recaptcha' => '您必須驗證成功才能繼續'
        ];
    }
}
