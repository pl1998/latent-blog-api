<?php


namespace App\Http\Requests\Api;


class TopicRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|between:2,25|regex:/^[A-Za-z0-9\-\_]+$/',
            'email' => 'required|email',
            'content' => 'required',
            'category_id' => 'required:int',

        ];
    }

    public function attributes()
    {
        return [
            'name.required' => '账号必须填写',
            'email' => '不是一个合格的邮箱地址',
            'name.between'=>'账号的长度不正确',
            'name.unique'=>'账号已经被注册过了',
            'name.between'=>'昵称太短了',

        ];
    }
}
