<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicsController extends Controller
{

    /**
     * 评论显示
     */
    public function show(Request $request)
    {
        if(empty($request->id)) {
            return response('参数不完整',500);
        }
       $topic =  Topic::query()->find($request->id);

       return json_encode($topic->toArray());
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
dd($request->all());

//        if(empty($request->category_id)){
//            return response('参数不完整',500);
//        }
        $data = $request->all();


        Topic::query()->create([
            'topic_id'=>$request->topic_id,
            'category_id'=>$request->category_id,
            'user_id'=>$request->user_id,
            'to_uid'=>$data['to_uid'] ?  $data['to_uid'] : '',
            'content'=>$data['content'],
        ]);
        return response('评论成功',200);
    }

    /**
     * @param Request $request
     */

    public function update(Request $request)
    {

    }
}
