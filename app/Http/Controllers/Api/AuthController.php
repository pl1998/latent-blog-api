<?php


namespace App\Http\Controllers\Api;


use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
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
        $user=User::where('github_name',$user->name)->first();
        if(empty($user)){
            $user=User::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'github_name'=>$user->name,
                'avatar'=>$user->avatar,
                'verified'=>1,
            ]);
        }
        Auth::login($user);
        return  Redirect()->guest('/register');
    }
}
