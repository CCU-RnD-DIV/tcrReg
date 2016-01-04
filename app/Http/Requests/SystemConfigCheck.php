<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SystemConfigCheck extends Request
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
            'start_reg' => 'required',
            'end_reg' => 'required',
            'start_survey' => 'required',
            'end_survey' =>'required',
            'final_out' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'start_reg.required' => '請填寫註冊開始時間',
            'end_reg.required' => '請填寫註冊截止時間',
            'start_survey.required' => '請填寫開始調查時間',
            'end_survey.required' => '請填寫截止調查時間',
            'final_out.required' => '請填寫錄取公佈時間'
        ];
    }
}
