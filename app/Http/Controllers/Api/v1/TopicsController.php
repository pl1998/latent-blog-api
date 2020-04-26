<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TopicRequest;
use App\Http\Resources\ApiTopics;
use App\Mail\TopicsEmail;
use App\Models\Topic;
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
        $topics = $topic->where('category_id',$request->id)->paginate(20);


        return ApiTopics::collection($topics);
    }

    /**
     * @param Request $request
     */
    public function store(TopicRequest $request)
    {
        $params = $request->all();

        //$params['content'] = $params['content']['content'];


        Topic::query()->create($params);

        $params['url'] = env('APP_RUL') . '/article/'.$params['category_id'].'/xsfsfsafasadfasewasfwevwefwe';


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
