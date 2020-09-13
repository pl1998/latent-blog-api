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
                'client_secret'=> env('GITHUB_CLIENT_SECRET'),
                'code'         => $code,
                'client_id'    => env('GITHUB_CLIENT_ID'),
                'redirect_uri' => env('GITHUB_CALLBACK_URL'),
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
