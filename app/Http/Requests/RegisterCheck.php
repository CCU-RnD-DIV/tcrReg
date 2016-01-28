<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterCheck extends Request
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
            'email' => 'required|email|unique:tcr_users,email',
            'password' => 'required|min:8',
            'cmf_pwd' => 'required|same:password',
            'pid' => 'required|unique:tcr_users,pid|pid',
            'name' => 'required',
            'gender' => 'required|boolean',
            'tc_class' => 'required',
            'type' => 'required',
            'school' =>'required|exists:tcr_school_list,school_code',
            'phone' => 'required|regex:/^09\d{2}?\d{3}?\d{3}$/',
            'agree' => 'required',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '請填寫您的電子郵件',
            'email.email' => '請填寫正確的電子郵件格式',
            'email.unique' => "此帳號已存在，或許您應該試試登入？<a href=\"generalLogin\">由此登入</a>",
            'password.required' => '請填寫您的密碼',
            'cmf_pwd.required' => '請再輸入一次確認密碼',
            'cmf_pwd.same' => '您的密碼兩者不符',
            'pid.required' => '請填寫您的身分證字號',
            'pid.unique' => '此身分證字號已存在',
            'pid.pid' => '請填寫正確的身分證字號格式，首字應為大寫',
            'name.required' => '請填寫您的真實姓名',
            'gender.required' => '請選擇您的性別',
            'tc_class.required' => '請選擇您的教師身份別',
            'type.required' => '請選擇您是國中小教師',
            'school.required' => '請選擇您服務的學校',
            'phone.required' => '請填寫您的手機號碼',
            'phone.regex' => '請填寫符合格式的手機號碼',
            'agree.required' => '您必須同意本網站之隱私權規則才能繼續註冊',
            'g-recaptcha-response.required' => '您必須進行驗證才能註冊',
            'g-recaptcha-response.recaptcha' => '您必須驗證成功才能註冊'
        ];
    }
}
