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
        $this->gitee_secret = env('GITEE_SECRET');
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

    public function getAccessToken($code,$get_access_url)
    {
        $access_url = sprintf($get_access_url,$code,$this->gitee_client_id,$this->gitee_redirect_url,$this->gitee_secret);

        return $this->client->request('POST',$access_url);
    }
}
