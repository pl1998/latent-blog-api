<?php


namespace App\Http\Controllers\Api\v1;


use App\Models\AboutMeModel;
use App\Models\LeaveMessageModel;
use Illuminate\Http\Request;

class AboutMeController
{
    public function index(AboutMeModel $aboutMeModel)
    {
        $about = $aboutMeModel->first();
        return json_encode($about,JSON_UNESCAPED_UNICODE);
    }

    public function leave(Request $request)
    {
        $page     = $request->get('page',1);
        $pageSize = $request->get('pageSize',10);
        $list = LeaveMessageModel::query()->where('status',2)
            ->orderByDesc('created_at')
            ->select(['id','name','email','content','created_at','url'])
            ->get();

        return response(json_encode([
            'code'=>200,
            'msg'=>'success',
            'data'=>$list
        ]),200);
    }
}
