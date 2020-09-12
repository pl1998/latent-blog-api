<?php


namespace App\Http\Controllers;


use App\Http\Controllers\OathTrians\GiteeOauth;
use App\Models\User;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Overtrue\LaravelSocialite\Socialite;



class AuthController extends Controller
{

    use GiteeOauth;
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        $users = User::where('github_id', $user->id)->first();

        if (empty($users)) {
            $users = User::create([
                'name' => $user->username,
                'email' => $user->email,
                'github_name' => $user->name,
                'github_id' => $user->id,
                'avatar' => $user->avatar,
                'verified' => 1,
                'password' => Hash::make('123456'),
                'bound_oauth' => 1,
            ]);
        }
        $token = Auth::guard('api')->login($users);
        //授权回调
        return view('loading', [
            'token' => $token,
            'domain' => env('APP_CALLBACK'),
        ]);

    }
    public function login()
    {
        return view('login');
    }

    public function handleProviderGiteeCallback(Request $request)
    {
        $code = $request->get('code');
        $result = $this->getAccessToken($code);
        $result = $result->getBody()->getContents();
        $result = json_decode($result,true);
        $access_token = $result['access_token'];

        $userInfo = $this->getUserInfo($access_token);

        $userInfo = json_decode($userInfo->getBody()->getContents(),true);


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
            'domain' => env('APP_CALLBACK'),
        ]);


    }













}
