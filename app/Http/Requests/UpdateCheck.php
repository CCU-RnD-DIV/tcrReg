<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateCheck extends Request
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
            'up_email' => 'email|unique:tcr_users,email',
            'cmf_email' => 'required_unless:up_email,|same:up_email',
            'password' => 'min:8',
            'cmf_password' => 'required_unless:password,|same:password|min:8',
            'name' => 'required',
            //'gender' => 'required',
            'type' => 'required',
            'tc_class' => 'required',
            'school' =>'required',
            'phone' => 'required|regex:/^09\d{2}?\d{3}?\d{3}$/'
        ];
    }

    public function messages()
    {
        return [
            'up_email.email' => '請填寫正確的電子郵件格式',
            'up_email.unique' => "此帳號已存在",
            'cmf_email.required_unless' => '請再一次確認您的電子郵件',
            'cmf_email.same' => '您的電子郵件兩者不符',
            'password.min' => '密碼最少八個字元',
            'cmf_password.min' => '密碼最少八個字元',
            'cmf_password.same' => '您的密碼兩者不符',
            'cmf_password.required_unless' => '請再一次確認您的密碼',
            'name.required' => '請填寫您的真實姓名',
            //'gender.required' => '請選擇您的性別',
            'type.required' => '請選擇您是國中小老師',
            'tc_class.required' => '請選擇您的教師身份別',
            'school.required' => '請選擇您的學校',
            'phone.required' => '請填寫您的手機號碼',
            'phone.regex' => '請填寫符合格式的手機號碼'
        ];
    }
}
