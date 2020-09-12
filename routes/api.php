<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('v1')->name('api.v1.')
//    ->middleware('throttle:1,1')
    ->group(function () {
        Route::get('categories', 'Api\v1\CategoryController@getCategoryTree');

        //文章
        Route::get('articles', 'Api\v1\ArticleController@getArticleList');
        //热门文章
        Route::get('articles/hot', 'Api\v1\ArticleController@hotList');

        Route::get('article/{id}/{slug}', 'Api\v1\ArticleController@show');
        Route::get('likes', 'Api\v1\LikesController@all')->name('api.likes.all');
        Route::post('likes', 'Api\v1\LikesController@store')->name('api.likes.store');
        Route::get('show', 'Api\v1\LabelsController@show')->name('api.labels.show');
        // 用户注册
        Route::post('users', 'Api\v1\UsersController@store')->name('users.store');
        //用户登录
        Route::post('authorizations', 'Api\v1\AuthorizationController@store')->name('api.authorizations.store');
        //刷新token
        Route::put('authorizations', 'Api\v1\AuthorizationController@update')->name('api.authorizations.update');

        //删除token
        Route::delete('authorizations', 'Api\v1\AuthorizationController@destroy')->name('api.authorizations.destroy');
        // 某个用户的详情
        Route::get('users/{user}', 'Api\v1\UsersController@show')->name('users.show');

        // 当前登录用户信息
        Route::middleware('auth:api')->group(function() {

            Route::get('user', 'Api\v1\UsersController@me')
                ->name('user.show');

            Route::post('subscription','Api\v1\SubscriptionController@store')->name('订阅');
        });

        //评论列表
        Route::post('topics','Api\v1\TopicsController@store')->name('topics.store');
        Route::put('topics/{id}/update','Api\v1\TopicsController@update')->name('topics.update');
        Route::get('topics/{id}','Api\v1\TopicsController@show')->name('topics.show');

        //邮件发送
        //注册邮箱验证码
        Route::post('send/email', 'Api\v1\EmailSendController@RegisterEamil')->name('api.EmailSend.send');
        //给latent留言
        Route::post('send/leaveMessage', 'Api\v1\EmailSendController@leaveMessage')->name('api.leaveMessage.send');


        Route::get('weibo/share', 'Api\v1\ShareController@weiBoShare');

        //文档归档
        Route::get('pigeonhole','Api\v1\ArticleController@pigeonhole');
        Route::get('about_me','Api\v1\AboutMeController@index');
        Route::get('leave','Api\v1\AboutMeController@leave');

    });



//Route::middleware('throttle:' . config('api.rate_limits.access'))
//    ->group(function () {
//
//    });
