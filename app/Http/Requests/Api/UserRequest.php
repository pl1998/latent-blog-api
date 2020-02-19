<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name',
            'email' => 'required|email|unique:users',
            'password' => 'required|alpha_dash|min:6',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function attributes()
    {
        return [
            'name.required' => '账号必须填写',
            'email' => '不是一个合格的邮箱地址',
            'name.between'=>'账号的长度不正确',
            'name.unique'=>'账号已经被注册过了',
            'password.password' => '密码必须填写',
            'password.min' => '密码不能小于6',
            'confirm_password' => '密码不一致',
        ];
    }
}
