<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;

class ShareController extends Controller
{
    public function weiBoShare()
    {
        $app = new \SaeTClientV2(env('WEIBO_APP_KEY'),env('WEIBO_APP_SECRET'));

    }
}
