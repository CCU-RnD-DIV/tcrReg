<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TrafficCheck extends Request
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
            'traffic' => 'required|between:0,4'
        ];
    }

    public function messages()
    {
        return [
            'traffic.required' => '請選擇交通方式'
        ];
    }
}
