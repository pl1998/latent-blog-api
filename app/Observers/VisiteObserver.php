<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\VisitorRegistry;

class VisiteObserver
{
    /**
     * Handle the visitor registry "created" event.
     *
     * @param  \App\Models\VisitorRegistry  $visitorRegistry
     * @return void
     */
    public function created(VisitorRegistry $visitorRegistry)
    {
        //
        $article =   Article::query()->find($visitorRegistry->art_id);
        $article->update([
            'review_count' => $article->review_count+1
        ]);
    }

    /**
     * Handle the visitor registry "updated" event.
     *
     * @param  \App\Models\VisitorRegistry  $visitorRegistry
     * @return void
     */
    public function updated(VisitorRegistry $visitorRegistry)
    {
        //
    }

    /**
     * Handle the visitor registry "deleted" event.
     *
     * @param  \App\Models\VisitorRegistry  $visitorRegistry
     * @return void
     */
    public function deleted(VisitorRegistry $visitorRegistry)
    {
        //
    }

    /**
     * Handle the visitor registry "restored" event.
     *
     * @param  \App\Models\VisitorRegistry  $visitorRegistry
     * @return void
     */
    public function restored(VisitorRegistry $visitorRegistry)
    {
        //
    }

    /**
     * Handle the visitor registry "force deleted" event.
     *
     * @param  \App\Models\VisitorRegistry  $visitorRegistry
     * @return void
     */
    public function forceDeleted(VisitorRegistry $visitorRegistry)
    {
        //
    }
}
