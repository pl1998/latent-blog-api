<?php


namespace App\Http\Controllers\Oath;


use App\Http\Controllers\Controller;

class QqOathLogin extends Controller
{
    private static $oath_url = 'https://graph.qq.com/user/get_user_info';
    private static $access_token = 'https://graph.qq.com/user/get_user_info';
    private static $app_id = '101707975';
}
