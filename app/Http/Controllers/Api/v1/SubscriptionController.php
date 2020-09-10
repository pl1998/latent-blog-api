<?php
/**
 * Created by PhpStorm
 * User: pl
 * Date: 2020/9/10
 * Time: 15:47
 */

namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Models\SubscribeModel;


class SubscriptionController extends Controller
{


    public function store(SubscribeModel $model)

    {
        $email = auth()->user()->email;

        $regex ="/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";

        $result = preg_match($regex,$email);

        if($result == 0) {
            return response(json_encode(['msg'=>'订阅失败:不是一个合格的邮箱']),500);
        }

        $model->email  = $email;
        $model->client = env('REDIS_CLIENT_SUBSCRIBE');

        $model->save();

        return response(json_encode(['msg'=>'订阅成功']),200);

    }


}
