<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HabitCheck extends Request
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
            'meat_veg' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'meat_veg.required' => '請選擇葷或素'
        ];
    }
}
