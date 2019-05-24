<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopPost extends FormRequest
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
     *///表单cmd验证-3
    public function rules()
    {
        return [
            'brand_name' => 'required|unique:shop|max:255',
            'brand_logo' => 'required',
            'brand_url' => 'required',
            'brand_desc' => 'required'
        ];
    }

    public function messages(){
         return [
         'brand_name.required' => '商品名称必填',
         'brand_logo.required' => '商品logo必填',
         'brand_url.required' => '商品url必填',
         'brand_desc.required' => '商品详情必填',
         'brand_name.unique' => '商品名称已存在',
         'brand_name.max' => '商品名称超出最大值'
         ];
    }

}
