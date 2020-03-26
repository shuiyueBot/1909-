<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookBlogPost extends FormRequest
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
            'bname'=>'required|unique:book|',
            'bman'=>'required',
        ];
    }
    public function messages(){
        return [
            'bname.required'=>'图书名称必填',
            'bname.unique'=>'图书已存在',
            'bman.required'=>'作者不能为空'
        ];
    }
}
