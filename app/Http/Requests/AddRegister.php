<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddRegister extends Request
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
            'password' => 'required',
            'cmf_pwd' => 'required|same:password',
            'pid' => 'required',
            'name' => 'required',
            'gender' => 'required',
            //'school' =>'required',
            'phone' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '請填寫您的電子郵件',
            'email.email' => '請填寫正確的電子郵件格式',
            'password.required' => '請填寫您的密碼',
            'cmf_pwd.required' => '請再輸入一次確認密碼',
            'cmf_pwd.same' => '您的密碼兩者不符',
            'pid.required' => '請填寫您的身分證字號',
            'name.required' => '請填寫您的真實姓名',
            'gender.required' => '請選擇您的性別',
            //'school.required' => '請選擇您的學校',
            'phone.required' => '請填寫您的手機號碼'
        ];
    }
}
