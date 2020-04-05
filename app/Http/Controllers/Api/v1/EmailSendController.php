<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;

use App\Mail\VerifyRegisterShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class EmailSendController extends Controller
{


    public function seedEmail(Request $request)
    {
        $data = $request->all();

        // $data['token'] ? $data['token'] : $data['token'] = md5($data['email']);
        //dd($data);

        $res = ['email' => $data['email'], 'name' => $data['email']];

        //缓存code
        $code = rand(100000, 999999);
        Cache::add('md' . $data['email'], $code, 360);

        $name = '我发的第一份邮件';
        // Mail::send()的返回值为空，所以可以其他方法进行判断
        Mail::send('emails.test',['name'=>$name],function($message){
            $to = '2540463097@qq.com'; $message ->to($to)->subject('邮件测试');
        });
        // 返回的一个错误数组，利用此可以判断是否发送成功
        dd(Mail::failures());


    }
}
