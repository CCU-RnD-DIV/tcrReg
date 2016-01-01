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
            'verify' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'verify.required' => '請填寫您收到的驗證碼',
            'verify.min' => '驗證碼最少為六個字'
        ];
    }
}
