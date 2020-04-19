<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Mail\RegisterEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;


class EmailSendController extends Controller
{

    protected $time = 180;

    /**
     * @param Request $request
     * 注册邮箱验证码
     */

    public function RegisterEamil(Request $request)
    {
        $data = $request->all();

        $redis = Redis::connection();
        $code = rand(100000, 999999);
        $data['code'] = $code;
        $data['slot'] = '';
        $data['url'] = env('APP_RUL') . '/auth/registe';
        $redis->set($data['email'], $code, $this->time);

        Mail::send(new RegisterEmail($data));
    }
}
