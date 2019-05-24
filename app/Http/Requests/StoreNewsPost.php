<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreNewsPost extends FormRequest
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
        $news_id=request()->news_id;
        // dd($news_id);
        return [
            'news_name' => [
                 'required',
                 Rule::unique('news')->ignore($news_id,'news_id'),
             ],
            // 'news_name' => 'required|unique:news',
            'file_id' => 'required',
            'news_zyx' => 'required',
            'news_show' => 'required',
        ];
    }

    public function messages(){
        return [
            'news_name.required' => '文章标题不能为空',
            'news_name.unique' => '文章标题已经存在',
            'file_id.required' => '文章分类不能为空',
            'news_zyx.required' => '文章重要性不能为空',
            'news_show.required' => '文章是否显示不能为空',
        ];
}

}
