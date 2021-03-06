<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;

//Route::get('/{any}', 'SpaController@index')->where('any', '.*');
//Route::get('/', 'SpaController@index');
//Route::get('/article/{id}/{slug}', 'SpaController@index');
//Route::get('/login', 'SpaController@index');
//Route::get('/register', 'SpaController@index');
//Route::get('/register', 'SpaController@index');
//Route::get('/tag/{tags}', 'SpaController@index');
//Route::get('/likes', 'SpaController@index');
//Route::get('/logout', 'SpaController@index');
//
//
//github登录
Route::get('/oauth/github', 'AuthController@redirectToProvider');
Route::get('/oauth/callback', 'AuthController@handleGithubCallback');
Route::get('/qq/login','AuthController@login');

//码云登录
Route::get('/oauth/gitee', 'AuthController@redirectGitee');
Route::get('/oauth/giteeCallback', 'AuthController@handleGiteeCallback');

Route::get('/oauth/qqLogin', 'AuthController@redirectToProvider');
Route::get('/oauth/qqCallback', 'AuthController@redirectToProvider');

//登录中转页面
Route::get('/LoginLoading', 'SpaController@loading');
Route::get('/send/email','MailSendController@emailSend')->name('send.email.view');
//Route::get('/send/email','MailSendController@emailSend')->name('send.email.view');


Route::get('weibo/login','AuthController@handleWeiBoCallback')->name('index.wb');
Route::get('weibo/authorization','WeiBoController@authorization')->name('authorization.wb');

//


