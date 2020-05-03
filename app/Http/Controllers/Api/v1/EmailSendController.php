<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Mail\RegisterEmail;
use App\Mail\LeaveMessage;
use App\Models\LeaveMessageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Validator;


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
        $redis->set('check_'.$data['email'],$code);

        Mail::send(new RegisterEmail($data));
    }

    /**
     * @param Request $request
     * 留言
     */
    public function leaveMessage(LeaveMessageModel $messageModel , Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:20',
            'email' => 'required|email',
            'content' => 'required|min:4|max:255',
        ]);


        $params = $request->all();

        if($validator->fails()){
            return response(json_encode(['msg'=>$validator->getMessage()]), 500);
        }


        try {
            $params['status'] = 0;
            Mail::send(new LeaveMessage($params));

        }catch (\Exception $exception){
            $params['status'] = 1;
        }

        $messageModel->name = $params['name'];
        $messageModel->email = $params['email'];
        $messageModel->content = $params['content'];
        $messageModel->status = $params['status'];
        $messageModel->save();

        if($params['status']==0){
            return response(json_encode(['msg'=>'留言成功','code'=>200]), 200);
        } else{
            return response(json_encode(['msg'=>'留言失败','code'=>500]), 500);
        }

    }
}
