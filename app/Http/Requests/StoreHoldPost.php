<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHoldPost extends FormRequest
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
            'hold_name' => 'required|unique:hold|max:255',
            'hold_url' => 'required',
            'hold_file' => 'required',
            'hold_show' => 'required',
        ];
    }

    public function messages(){
        return [
        'hold_name.required' => '用户名必填',
    ];
}

}
