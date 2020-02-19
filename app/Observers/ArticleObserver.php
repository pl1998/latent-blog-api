<?php

namespace App\Observers;

use App\Helpers\Translate;
use App\Models\Article;


class ArticleObserver
{
    /**
     * Handle the article "created" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function created(Article $article)
    {
        //
        //对标题进行翻译
        if (!$article->slug) {
            $article->slug = app(Translate::class)->translate($article->title);
        }
    }




/**
     * Handle the article "updated" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updated(Article $article)
    {
        if (!$article->slug) {
            $article->slug = app(Translate::class)->translate($article->title);
        }
    }

    /**
     * Handle the article "deleted" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function deleted(Article $article)
    {
        //
    }

    /**
     * Handle the article "restored" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function restored(Article $article)
    {
        //
    }

    /**
     * Handle the article "force deleted" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function forceDeleted(Article $article)
    {
        //
    }
}
