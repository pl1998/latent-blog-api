<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    $router->resource('users', UserController::class);
    $router->resource('article', ArticleController::class);
    $router->resource('label', LabelController::class);
    $router->resource('category', CategoryController::class);
    $router->resource('topic', TopicController::class);
    $router->resource('likes', LikesController::class);

    //下拉导航
    $router->get('api/category', 'CategoryController@apiIndex');
    $router->get('api/getCategoryList', 'CategoryController@apiCategory');

});
