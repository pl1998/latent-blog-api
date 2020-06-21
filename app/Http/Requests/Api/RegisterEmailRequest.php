<?php


namespace App\Http\Requests\Api;


class RegisterEmailRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
        ];

    }

    public function attributes()
    {
        return [
            'email' => '邮箱已经注册过了,请勿重复注册!',
        ];
    }

}
