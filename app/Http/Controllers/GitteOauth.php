<?php


namespace App\Http\Controllers;


use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GitteOauth extends Controller
{
    public function redirectGitee()
    {
        $this->getGiteeCode();
    }

    public function handleProviderGiteeCallback(Request $request,Client $client)
    {
        $params = $request->all();
        $this->getAccessToken($params['code'],env('GITEE_ACCESS_TOKEN_URL'));

    }
}
