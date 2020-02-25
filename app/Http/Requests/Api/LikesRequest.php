<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LikesRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name'=>'required|unique:likes,name',
            'email'=>'required|email|unique:likes,email',
            'blog_url'=>'required|url',
            'signature'=>'required|min:3',

        ];
    }

    public function attributes()
    {
        return [
            'name.required' => '名称必须填写',
            'email.email' => '不是一个合格的邮箱地址',
            'name.between'=>'账号的长度不正确',
            'email.unique'=>'邮箱已提交过了',
            'blog_url.url' => '请输入合格的网址',
        ];
    }
}
