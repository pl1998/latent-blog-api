<?php


namespace App\Http\Controllers;


use App\Http\Controllers\OathTrians\GiteeOauth;
use App\Http\Controllers\OathTrians\GithubOauth;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;





class AuthController extends Controller
{



    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
//    public function redirectToProvider()
//    {
//        return Socialite::driver('github')->redirect();
//    }

    /**
     * Obtain the user information from GitHub
     * @return Response
     */
    public function handleGithubCallback(Request $request,GithubOauth $oauth)
    {
        $code = $request->get('code');
        $result       = $oauth->getAccessToken($code);
        $result       = $result->getBody()->getContents();
        $params       = explode('=',$result);
        $access_token = $params[1];
        $access_token = explode('&',$access_token);
        $access_token = $access_token[0];

        $userInfo = $oauth->getUserInfo($access_token);
        $userInfo = json_decode($userInfo->getBody()->getContents(),true);

        $users = User::where('github_id', $userInfo['id'])->first();

        if (empty($users)) {
            $users = User::create([
                'github_id' => $userInfo['id'],
                'name' => $userInfo['login'],
                'avatar' => $userInfo['avatar_url'],
                'email' => $userInfo['email'],
                'created_at' => date('Y-m-d H:i:s'),
                'github_name' => $userInfo['name'],
                'user_json' => json_encode($userInfo,JSON_UNESCAPED_UNICODE),
                'bound_oauth'=>1
            ]);
        }

        $token = Auth::guard('api')->login($users);
        //授权回调
        return view('loading', [
            'token' => $token,
            'domain' => env('APP_CALLBACK','https://pltrue.top/'),
        ]);

    }
    public function login()
    {
        return view('login');
    }

    /**
     * gitee 回调地址
     * @param Request $request
     * @return response
     */
    public function handleGiteeCallback(Request $request,GiteeOauth $oauth)
    {
        $code         = $request->get('code');
        $result       = $oauth->getAccessToken($code);
        $result       = $result->getBody()->getContents();
        $result       = json_decode($result,true);
        $access_token = $result['access_token'];
        $userInfo     = $oauth->getUserInfo($access_token);
        $userInfo     = json_decode($userInfo->getBody()->getContents(),true);
        $user = User::query()->where('gitee_id',$userInfo['id'])->first();

        if(empty($user)) {
            $user = User::query()->create([
               'gitee_id' => $userInfo['id'],
               'name' => $userInfo['login'],
               'avatar' => $userInfo['avatar_url'],
               'email' => $userInfo['email'],
               'created_at' => date('Y-m-d H:i:s'),
               'github_name' => $userInfo['name'],
               'user_json' => json_encode($userInfo,JSON_UNESCAPED_UNICODE),
                'bound_oauth'=>2
            ]);
        }

        $token = Auth::guard('api')->login($user);

        return view('loading', [
            'token' => $token,
            'domain' => env('APP_CALLBACK','https://pltrue.top/'),
        ]);
    }
}
