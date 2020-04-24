<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Triats\LoginWeiBoTrait;
use App\Models\User;
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

        $this->user($param['access_token'], $param['uid']);
    }

    public function authorization()
    {
       $this->getCode();
    }

    public function user($access_token, $uid)
    {
        $userInfo = $this->getUserInfo($access_token, $uid);

        $userInfo['wb_id'] = $uid;

//        User::query()->create([
//
//        ]);

        return view('loading', [
            'token' => json_encode($userInfo),
            'domain' => env('APP_CALLBACK'),
        ]);


    }
}
