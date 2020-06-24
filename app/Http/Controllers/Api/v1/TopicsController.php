<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TopicRequest;
use App\Http\Resources\ApiTopics;
use App\Mail\TopicsEmail;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TopicsController extends Controller
{

    /**
     * 评论显示
     */
    public function show(Request $request)
    {
        if (empty($request->id)) {
            return response('参数不完整', 500);
        }
        $topic =Topic::query();
        $topics = $topic->where('article_id',$request->id)->orderBy('created_at')->paginate(20);

        foreach ($topics as $value){
            $value->email = $value->user->email;
            $value->avatar = $value->user->avatar;
            $value->name = $value->user->name;

        }

        return ApiTopics::collection($topics);
    }

    /**
     * @param Request $request
     */
    public function store(TopicRequest $request,User $user)
    {
        $params = $request->all();


        Topic::query()->create($params);

        $params['url'] = env('APP_RUL') . '/article/'.$params['article_id'].'/xsfsfsafasadfasewasfwevwefwe';
        $users = $user->find($params['user_id']);

        $params['email'] = $users->email;
        $params['name'] = $users->name;
        Mail::send(new TopicsEmail($params));

        return response(json_encode(['msg'=>'评论成功']), 200);
    }

    /**
     * @param Request $request
     */

    public function update(Request $request)
    {

    }
}
