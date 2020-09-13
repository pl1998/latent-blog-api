<?php


namespace App\Http\Controllers\OathTrians;


use GuzzleHttp\Client;

class WeiBoOauth
{
    /**
     * @param $code
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccessToken($code)
    {
        $url = 'https://api.weibo.com/oauth2/access_token';
        $client = new Client();
        return $client->request('POST',$url,[
            'form_params'=>[
                'client_id' => env('WEIBO_CLIENT_ID','1949419161'),
                'client_secret' => env('WEIBO_CLIENT_SECRET','38ad194c8302f42d8d6c7bc7704595e7'),
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => env('WEIBO_REDIRECT_URL','https://api.pltrue.top/weibo/login'),
               // 'redirect_uri' => 'http://blog.test/weibo/login',
            ]
        ]);
    }

    public function getUserInfo($access_token)
    {
        $url = 'https://api.weibo.com/2/users/show.json';
        $client = new Client();
        return $client->request('POST',$url,[
            'form_params'=>[
                'access_token'=>$access_token
            ]
        ]);
    }
}
