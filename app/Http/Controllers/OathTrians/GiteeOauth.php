<?php


namespace App\Http\Controllers\OathTrians;


use GuzzleHttp\Client;

trait GiteeOauth
{
    private $gitee_client_id;
    private $gitee_secret;
    private $gitee_code;
    private $gitee_redirect_url;
    private $authorize_url;
    private $client;
    private $access_token;

    /**
     * GiteeOauth constructor.
     */

    public function __construct()
    {
        $this->gitee_client_id = env('GITEE_CLIENT_ID');
        $this->gitee_secret = env('GITEE_CLIENT_SECRET');
        $this->gitee_redirect_url = env('GITEE_REDIRECT_URL');
        $this->authorize_url = env('GITEE_AUTHORIZE_URL');
        $this->client = new Client();
    }

    public function getCodeUrl()
    {
        $url = sprintf($this->authorize_url, $this->gitee_client_id, $this->gitee_secret);
        return $url;
    }

    /**
     * 发送登录请求
     */


    public function getGiteeCode()
    {

        $oath_url = $this->getCodeUrl();
        $result = $this->client->request('GET', $oath_url);
        if ($result->getStatusCode() == 200) return;

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
