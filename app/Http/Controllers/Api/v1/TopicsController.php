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

class TopicsController
{

    /**
     * 评论显示
     */
    public function show(Request $request)
    {


        $page = $request->get('page',1);
        $pageSize = $request->get('pageSize',10);
        if (empty($request->id)) {
            return response('参数不完整', 500);
        }
        $topic =Topic::query();
        $topics = $topic->where('article_id',$request->id)->orderBy('created_at')->paginate(20);

        foreach ($topics as $value){
            $value->email = $value->user->email;
            $value->avatar = $value->user->avatar;
            $value->name = $value->user->name;
            unset($value->user);
        }



        $topics = $topics->toArray();

        //$topics = $topics->toArray();

        $tree = getTree($topics['data']);

        $list = ['data'=>$tree,'likes'=>[],'meta'=>['current_page'=>$topics['current_page'],'last_page'=>$topics['last_page']]];
        return  response(json_encode($list),200);



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

        if(!empty($params['email'])){
            Mail::send(new TopicsEmail($params));
        }
        return response(json_encode(['msg'=>'评论成功']), 200);
    }

    /**
     * @param Request $request
     */

    public function update(Request $request)
    {

    }
}
