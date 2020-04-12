<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\VisitorRegistry;
use App\server\EventLook;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class VisitArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ip = getRealIpAddr(); //获取访问ip
        if (!empty($ip)) {
            //判断该文章是否相对应的ip
            $visitor = VisitorRegistry::query()->where('ip', $ip)->where('art_id', $this->article->id)->first();

                if (!$visitor) {
                    //新增一个文章访问记录
                    VisitorRegistry::query()->create([
                        'clicks'=>1,
                        'art_id'=>$this->article->id,
                        'ip'=>$ip,
                    ]);
                    return;
                } else {
                    $visitor->update(['clicks' => $visitor->clicks + 1]);
                    return;
                }
        } else {
            return;
        }

    }
}
