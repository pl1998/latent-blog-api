<?php


namespace App\Http\Requests\Api;




class leaveMessage extends FormRequest
{
    public function rules()
    {
       return [
           'name' => 'required|max:20',
           'email' => 'required|email',
           'url'=>'requred',
           'content' => 'required|min:4|max:255',
       ];
    }


}
