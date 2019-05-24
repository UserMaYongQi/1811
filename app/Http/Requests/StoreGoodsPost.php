<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoodsPost extends FormRequest
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
            'goods_name' => 'required|unique:goods|max:255',
            'goods_price' => 'required',
            'goods_file' => 'required',
            'is_down' => 'required'
        ];
    }

    public function messages(){
        return [
        'goods_name.required' => '商品名称必填',
        'goods_price.required' => '商品价格必填',
        'goods_file.required' => '商品图片必填',
        'is_down.required' => '是否上架必填',
        ];
    }
}
