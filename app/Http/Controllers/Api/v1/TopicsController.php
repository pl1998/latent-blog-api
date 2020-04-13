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
        if(empty($request->category_id)){
            return response('参数不完整',500);
        }
    }

    /**
     * @param Request $request
     */

    public function update(Request $request)
    {

    }
}
