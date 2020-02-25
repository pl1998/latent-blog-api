<?php


namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LikesRequest;
use App\Models\Likes;
use Illuminate\Auth\AuthenticationException;

class LikesController extends Controller
{
    public function all()
    {
        return Likes::query()->where('is_hide', 1)->get()->toArray();
    }

    public function store(LikesRequest $request)
    {
        try {
            Likes::query()->create($request->all());

        } catch (\Exception $exception) {
            throw new AuthenticationException('添加失败');
        }

        return json_encode(['code' => 200, 'message' => '添加成功']);
    }

    public function seedMail($data)
    {
        $res = ['email' => $data['email'], 'name' => $data['name']];

        Mail::send('emails.test', $res, function ($message) use ($res) {
            $to = $res['email'];
            $message->to($to)->subject('有人发送友情链接，请查看！');

        });

    }
}
