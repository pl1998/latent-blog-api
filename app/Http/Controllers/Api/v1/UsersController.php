<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    /**
     * 用户注册api
     */

    public function store(UserRequest $request)
    {
        $user = User::query()->create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>Hash::make($request->password),

        ]);
        return new UserResource($user);
    }
}
