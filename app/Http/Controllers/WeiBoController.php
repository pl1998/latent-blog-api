<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Triats\LoginWeiBoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeiBoController
{

    use LoginWeiBoTrait;

    public function index(Request $request)
    {
        $code = $request->code;
        //  $token = Auth::guard('api')->login($users);
        $param = $this->setGetWbAccessToken($code);
        dd($param);
        $this->getUserInfo();
    }

    public function authorization()
    {
        $code = $this->getCode();

        var_dump($code);die;
        $params = $this->setGetWbAccessToken($code);
        var_dump($params);
    }
}
