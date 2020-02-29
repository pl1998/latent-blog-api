<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Overtrue\LaravelSocialite\Socialite;



class AuthController extends Controller
{
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
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        $users=User::where('github_id',$user->id)->first();

        if(empty($users)){
            $user=User::create([
                'name'=>$user->username,
                'email'=>$user->email,
                'github_name'=>$user->name,
                'github_id'=>$user->id,
                'avatar'=>$user->avatar,
                'verified'=>1,
                'password'=>Hash::make('123456')
            ]);
            Auth::login($user);
        }else{
            Auth::login($users);
        }

        return  Redirect()->guest('/');
    }
}
