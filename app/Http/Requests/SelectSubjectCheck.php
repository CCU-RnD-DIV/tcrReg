<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SelectSubjectCheck extends Request
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
            'reg_subject_1' => 'required|different:reg_subject_2',
            'reg_subject_2' => 'required|different:reg_subject_1'
        ];
    }

    public function messages()
    {
        return [
            'reg_subject_1.required' => '此項必填',
            'reg_subject_2.required' => '此項必填',
            'reg_subject_1.different' => '兩天必須至少選填一項活動議程',
            'reg_subject_2.different' => '兩天必須至少選填一項活動議程'
        ];
    }
}
