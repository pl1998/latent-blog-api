<?php


namespace App\Http\Controllers\OathTrians;


use GuzzleHttp\Client;

class GithubOauth
{
    /**
     * 获取access_token
     * @param $code
     * @return mixed
     */
    public function getAccessToken($code)
    {
        $access_url = 'https://github.com/login/oauth/access_token';

        $client = new Client();
        return $client->request('POST',$access_url,[
            'form_params' => [
                'client_secret'=> env('GITHUB_CLIENT_SECRET','85e6932b0d8e811daa7c18f4e0bf3a7f0b113572'),
                'code'         => $code,
                'client_id'    => env('GITHUB_CLIENT_ID','46b6e2304c11077b5eb6'),
                'redirect_uri' => env('GITHUB_CALLBACK_URL','https://api.pltrue.top/oauth/callback'),
            ]
        ]);
    }

    /**
     * 获取用户信息
     * @param $access_token
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUserInfo($access_token)
    {
        $url      = 'https://api.github.com/user';
        $token    = "Bearer ".$access_token;
        $client   = new Client();
        return $client->request('GET',$url,[
            'headers' =>[
                'Authorization'=>$token
            ]
        ]);
    }
}
