<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\VisitorRegistry;
use App\Observers\ArticleObserver;
use App\Observers\VisiteObserver;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Carbon::setLocale('zh');
        //注册模型监听器
        VisitorRegistry::observe(VisiteObserver::class);
        Article::observe(ArticleObserver::class);
    }
}
