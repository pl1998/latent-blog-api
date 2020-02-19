<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\VisitorRegistry;

class VisitorRegistryObserver
{
    /**
     * @param VisitorRegistry $registry
     * 监听文章访问事件
     */
    public function created(VisitorRegistry $registry)
    {
      $article =   Article::query()->find($registry->art_id);

      $article->update([
         'review_count' => $article->review_count+1
      ]);
    }
}
