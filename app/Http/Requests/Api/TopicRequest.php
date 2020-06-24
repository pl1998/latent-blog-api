<?php


namespace App\Http\Requests\Api;


class TopicRequest extends FormRequest
{
    public function rules()
    {
        return [
            'content' => 'required',
            'user_id' => 'required',
            'article_id' => 'required:int',

        ];
    }

    public function attributes()
    {
        return [
            'user_id.required' => '用户未登录',
            'content.required' => '内容不能为空',
            'article_id.between'=>'评论对象不能为空',


        ];
    }
}
