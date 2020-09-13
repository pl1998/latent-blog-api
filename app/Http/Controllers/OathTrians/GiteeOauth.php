<?php


namespace App\Http\Controllers\OathTrians;


use GuzzleHttp\Client;

class GiteeOauth
{
    private $gitee_client_id;
    private $gitee_secret;
    private $gitee_code;
    private $gitee_redirect_url;
    private $authorize_url;
    private $client;
    private $access_token;

    /**
     * 获取配置参数
     * GiteeOauth constructor.
     */

    public function __construct()
    {
        $this->gitee_client_id = env('GITEE_CLIENT_ID','7e22fbb0ff807dd9768b88c5e4a89b92dedf4291e62ae395e5534b6f77122dde');
        $this->gitee_secret = env('GITEE_CLIENT_SECRET','5be9e613e923695165d6dd31cac72105a90b4413bb594aeeefa27cb7293ecab4');
        $this->gitee_redirect_url = env('GITEE_REDIRECT_URL','https://api.pltrue.top/oauth/giteeCallback');
        $this->authorize_url = env('GITEE_AUTHORIZE_URL','https://pltrue.top/');
        $this->client = new Client();
    }

    /**
     * 获取access_token
     */
    public function getAccessToken($code)
    {
        $access_url = sprintf('https://gitee.com/oauth/token?grant_type=authorization_code&code=%s&client_id=%s&redirect_uri=%s',$code,$this->gitee_client_id,$this->gitee_redirect_url);

        return $this->client->request('POST',$access_url,[
            'form_params' => [
                'client_secret'=>$this->gitee_secret
            ]
        ]);
    }

    /**
     * 获取用户信息
     */
    public function getUserInfo($access_token)
    {
        $url    = sprintf('https://gitee.com/api/v5/user?access_token=%s',$access_token);
        $result = $this->client->request('get',$url);
        return $result;
    }
}
