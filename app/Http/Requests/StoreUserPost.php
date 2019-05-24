<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPost extends FormRequest
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
        'user_name' => 'required|unique:user|max:255',
        'user_pwd' => 'required',
        ];
    }

    public function messages(){
         return [
            'user_name.required' => '用户名必填',
            'user_name.unique' => '用户名已经存在',
            'user_name.max' => '用户名超过最大值',
            'user_pwd.required' => '密码必填'
         ];
}

}
