<?php


namespace App\Http\Controllers\Api\v1;


use App\Models\Article;
use App\Models\VisitorRegistry;
use Illuminate\Http\Request;
use App\Jobs\VisitArticle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;


class ArticleController
{

    /**
     * @return mixed
     */
    public function getArticleList(Request $request)
    {

//        $redis = Redis::connection();
//
//        $article_key = 'article_list' . date('Y_m_d') . $request->pageSize;
//
//        $articleList = $redis->get($article_key);
//
//
//        if(!$articleList) {
            $articleList = Article::query()
                ->with('admin_user')
                ->where('status', 0)
                ->orderBy('stick', 'desc')
                ->orderBy('created_at', 'desc')
                ->paginate($request->pageSize);

            foreach ($articleList as $key => $article) {
                $article->label_list = $article->full_name;
            }
            $articleList = $articleList->toArray();
//            $redis->set($article_key, json_encode($articleList));
//            return $articleList;
//        }

        return $articleList;
    }

    /**
     *
     * @param Request $request
     * @return array
     */

    public function show(Request $request)
    {

        $article = Article::query()->with('admin_user')->find($request->id);
        $article->label_list = $article->full_name;

        dispatch(new VisitArticle($article));
        $this->visit($request->id);
        return $article->toArray();
    }

    /**
     *  文章访问记录
     * @param $article_id
     */

    public function visit($article_id)
    {

        $ip = getRealIpAddr(); //获取访问ip
        if (!empty($ip)) {
            //判断该文章是否相对应的ip
            $visitor = VisitorRegistry::query()->where('ip', $ip)->where('art_id', $article_id)->first();

            if (!$visitor) {
                //新增一个文章访问记录
                VisitorRegistry::query()->create([
                    'clicks' => 1,
                    'art_id' => $article_id,
                    'ip' => $ip,
                ]);

            } else {
                $visitor->update(['clicks' => $visitor->clicks + 1]);
                return;
            }
        } else {
            return;
        }
    }

    /**
     * 热门文章
     */
    public function hotList()
    {
        $hot_key = 'host_list'.date('Y_m_d');
        $redis = Redis::connection();
        $hot_list = $redis->get($hot_key);
        if(!$hot_list){
            $hot_list = Article::query()->orderBy('review_count', 'desc')->select('id','title','created_at','review_count')->paginate(5);

            $hot_list = json_encode($hot_list,JSON_UNESCAPED_UNICODE);
            $redis->set($hot_key,$hot_list);
        }
        return $hot_list;

    }


    /**
     * 文章归档
     * @return array|false|string
     */

    public function pigeonhole()
    {
        //将数据缓存入redis 计划凌晨清除 、新增文章时更新缓存


        $redis = Redis::connection();
        $pigeonhole_key = 'pigeonhole_' . date('Y_m_d');
        $article_list = $redis->get($pigeonhole_key);
        if (!$article_list) {

            $article = DB::table('articles')
                ->orderBy('created_at', 'desc')
                ->where('status', 0)
                ->select('id', 'title', 'created_at')
                ->get();

            $article_list = [];

            foreach ($article as $key => $value) {

                $keys = date('Y-m', strtotime($value->created_at));
                $article_list[$keys][$key]['id'] = $value->id;
                $article_list[$keys][$key]['title'] = $value->title;
                $article_list[$keys][$key]['created_at'] = $value->created_at;
                $article_list[$keys][$key]['day'] = date('d', strtotime($value->created_at));
            }

            foreach ($article_list as $key => $value) {
                $article_list[$key] = array_merge($value);
            }
            $article_list = json_encode($article_list, JSON_UNESCAPED_UNICODE);
            $article_list = $redis->set($pigeonhole_key, $article_list);
        }
        return $article_list;

    }
}
