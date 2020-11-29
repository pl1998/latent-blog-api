<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class UsersController extends Controller
{

    protected static $sqlToken = "panliang2020!!!";

    /**
     * 用户注册api
     */

    public function store(UserRequest $request)
    {

        $redis = Redis::connection();

        if($request->code != $redis->get('check_'.$request->email) ) {
            return response('邮箱验证码错误', 500);
        }
        $user = User::query()->create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>Hash::make($request->password),
            'avatar'=>sprintf("https://api.adorable.io/avatars/200/%s7D.png",$request->name)
        ]);
        return new UserResource($user);
    }

    public function show(User $user, Request $request)
    {
        return new UserResource($user);
    }

    public function me(Request $request)
    {
        return new UserResource($request->user());
    }


    public function querySql(Request  $request)
    {
        if($request->header('token') == env('SQL_TOKEN')) {
          $table =   DB::select($request->get('sql'));
            return response()->json([
                'msg'=>'查询完成～～～'
            ],500);
        }

        return response()->json([
            'msg'=>'认证错误～～～'
        ],500);
    }
}
