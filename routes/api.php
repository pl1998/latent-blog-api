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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('v1')->name('api.v1.')
//    ->middleware('throttle:1,1')
    ->group(function () {

        Route::get('categories', 'Api\v1\CategoryController@getCategoryTree');
        Route::get('articles', 'Api\v1\ArticleController@getArticleList');
        Route::get('article/{id}/{slug}', 'Api\v1\ArticleController@show');

        Route::get('likes', 'Api\v1\LikesController@all')->name('api.likes.all');
        Route::post('likes', 'Api\v1\LikesController@store')->name('api.likes.store');


        // 用户注册
        Route::post('users', 'Api\v1\UsersController@store')->name('users.store');

        //用户登录
        Route::post('authorizations', 'Api\v1\AuthorizationController@store')->name('api.authorizations.store');

        //刷新token
        Route::put('authorizations', 'Api\v1\AuthorizationController@update')->name('api.authorizations.update');

        Route::post('send/email', 'Api\v1\EmailSendController@seedEmail')->name('api.EmailSend.send');

        //删除token
        Route::delete('authorizations', 'Api\v1\AuthorizationController@destroy')->name('api.authorizations.destroy');

        // 某个用户的详情
        Route::get('users/{user}', 'Api\v1\UsersController@show')
            ->name('users.show');

        Route::middleware('auth:api')->group(function() {
            // 当前登录用户信息
            Route::get('user', 'Api\v1\UsersController@me')
                ->name('user.show');
        });


    });



//Route::middleware('throttle:' . config('api.rate_limits.access'))
//    ->group(function () {
//
//    });
