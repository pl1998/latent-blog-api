<?php


namespace App\Http\Controllers\Triats;





use App\Models\User;
use GuzzleHttp\Client;
use mysql_xdevapi\Exception;

Trait LoginWeiBoTrait
{
    private $key;
    private $secret_key;
    private $wb_callback_url;
    private $authorizeURL;
    private $accessTokenURL;
    private $accessUser;
    private $client;
    private $host;

    public function __construct()
    {
        $this->key = config('auto.wb_key');
        $this->secret_key = config('auto.wb_secret');
        $this->wb_callback_url = config('auto.wb_callback_url');
        $this->authorizeURL = config('auto.authorize_url');
        $this->accessTokenURL = config('auto.access_token_url');
        $this->accessUser = config('auto.access_user');
        $this->client = new Client();
    }

    /**
     *设置 获取 code 的url
     * @return string
     */

    public function setWbCodeUrl()
    {
        $url = sprintf($this->authorizeURL, $this->key, $this->wb_callback_url);
        return $url;
    }

    /**
     * 获取 code 的值
     * @return array
     */

    public function getCode()
    {
        $getCodeUrl = $this->setWbCodeUrl();
        return redirect()->away($getCodeUrl);
    }


    /**
     * @paran $code string授权获取access_token
     */

    public function setGetWbAccessToken($code)
    {
        if (!$code) {
            throw new Exception('缺少code');
        }
        $url = sprintf($this->accessTokenURL, $this->key, $this->secret_key, $this->wb_callback_url, $code);
        try {
            $res = $this->client->request('POST', $url)->getBody();

        } catch (\Exception $exception) {
           return $exception->getMessage();
        }

        return json_decode($res, true);
    }

    public function getUserInfo($access_token, $uid)
    {
        $arr = [
            'access_token' => $access_token,
            'uid' => $uid
        ];
        $users = new User();
        $user = $users->getUserInfo($uid,$filed='wb_id');

        if (!$user || empty($user)) {
            $url = config('SLogin.accessUser') . '?' . http_build_query($arr);
            try {
                $res = $this->client->request('GET', $url)->getBody();
            } catch (\Exception $e) {
                // 处理错误
                throw new \Exception([
                    'message' => $e->getMessage(),
                ]);
            }
            return json_decode($res, true);
        } else {
            var_dump($user);die;
            Auth::login($user, true);
            return redirect()->route('home');
        }

    }

}
