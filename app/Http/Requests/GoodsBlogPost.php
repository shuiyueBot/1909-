<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodsBlogPost extends FormRequest
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
            'goods_name'=>'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u|required|unique:goods',
            'goods_num'=>'required|max:8|not_regex:/^\d{8}$/',
            'goods_price'=>'required',
            'cate_id'=>'required',
            'brand_id'=>'required',
            
        ];
    }
    public function messages(){
        return [
            'goods_name.required'=>'商品名称必填',
            'goods_name.regex'=>'请使用中文或者数字字母下划线2位以上50位以下',
            'goods_name.unique'=>'该商品已存在',
            'goods_num.required'=>'库存不能为空',
            'goods_num.max'=>'库存过大',
            'goods_num.not_regex'=>'请填写真实库存',
            'goods_price.required'=>'商品价格不能为空',
            'cate_id.required'=>'分类不能为空',
            'brand_id.required'=>'品牌不能为空',
            
        ];
    }
}
