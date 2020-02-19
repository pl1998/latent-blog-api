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

Route::get('/getCategoryTree', 'Api\CategoryController@getCategoryTree');
Route::get('/getArticleList', 'Api\ArticleController@getArticleList');
Route::get('/article/{id}/{slug}', 'Api\ArticleController@show');

//github登录
Route::get('/oauth/github', 'Api\AuthController@redirectToProvider');
Route::get('/github/callback', 'Api\AuthController@handleProviderCallback');

Route::prefix('v1')->name('api.v1.')
    ->middleware('throttle:1,1')
    ->group(function () {
        // 用户注册
        Route::post('users', 'Api\v1\UsersController@store')->name('users.store');



    });



//Route::middleware('throttle:' . config('api.rate_limits.access'))
//    ->group(function () {
//
//    });
