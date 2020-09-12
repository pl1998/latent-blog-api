<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterEmailRequest;
use App\Mail\OrderShipped;
use App\Mail\RegisterEmail;
use App\Mail\LeaveMessage;
use App\Models\LeaveMessageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\Api\leaveMessage as leaveMessageRequest;


class EmailSendController extends Controller
{

    protected static $time = 500;

    /**
     * @param Request $request
     * 注册邮箱验证码
     */

    public function RegisterEamil(RegisterEmailRequest $request)
    {
        $data = $request->all();

        $redis = Redis::connection();
        $code = rand(100000, 999999);
        $data['code'] = $code;
        $data['slot'] = '';
        $data['url'] = env('APP_RUL') . '/auth/registe';
        $redis->set('check_'.$data['email'],$code,'',self::$time);

        Mail::send(new RegisterEmail($data));
    }

    /**
     * @param Request $request
     * 留言
     */
    public function leaveMessage(LeaveMessageModel $messageModel, Request $request)
    {

        $params = $request->all();
        try {
            $params['status'] = 0;
            Mail::send(new LeaveMessage($params));

        }catch (\Exception $exception){
            $msg = $exception->getMessage();
            $params['status'] = 1;
        }

        $messageModel->name = $params['name'];
        $messageModel->email = $params['email'];
        $messageModel->content = $params['content'];
        $messageModel->status = $params['status'];
        $messageModel->url = $params['url'];
        $messageModel->save();

        if($params['status']==0){
            return response(json_encode(['msg'=>'留言成功','code'=>200]), 200);
        } else{
            return response(json_encode(['msg'=>$msg,'code'=>500]), 500);
        }

    }
}
