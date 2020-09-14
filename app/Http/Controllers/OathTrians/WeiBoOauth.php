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

        $client_id     = env('WEIBO_CLIENT_ID','1949419161');
        $client_secret = env('WEIBO_CLIENT_SECRET','38ad194c8302f42d8d6c7bc7704595e7');
        $redirect_uri  = env('WEIBO_REDIRECT_URL','https://api.pltrue.top/weibo/login');

        $url = sprintf('https://api.weibo.com/oauth2/access_token?client_id=%s&client_secret=%s&grant_type=authorization_code&code=%s&redirect_uri=%s',$client_id,$client_secret,$code,$redirect_uri);

        $client = new Client();

        return  $client->post($url);

    }

    /**
     * 获取用户uid
     * @param $access_token
     * @return mixed
     */
    public function getUid($access_token)
    {
        $url = "https://api.weibo.com/oauth2/get_token_info?access_token=".$access_token;
        $client = new Client();
        $result =  $client->post($url);
        $result = json_decode($result->getBody()->getContents(),true);
        return $result['uid'];

    }

    /**
     * @param $access_token
     */
    public function getUserInfo($access_token)
    {
        $uid = $this->getUid($access_token);
        $url = 'https://api.weibo.com/2/users/show.json?uid='.$uid.'&access_token='.$access_token;
        $client = new Client();
        return $client->get($url);
    }
}
