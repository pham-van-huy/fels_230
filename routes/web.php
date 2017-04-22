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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//route for social login
Route::get('login/{provider}', 'Auth\SocialAuthController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

//route admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('home', 'Admin\HomeAdminController@index');
    Route::resource('category', 'Admin\CategoryController', ['expect' => ['show']]);
    Route::resource('user', 'Admin\UserController', ['except' => ['store', 'create', 'edit', 'update']]);
    Route::resource('word', 'Admin\WordController', ['except' => ['show']]);
});
//route for user
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('', 'User\HomeController@index');
    Route::resource('profile', 'User\UserController', ['only' => ['show', 'edit', 'update']]);
    Route::get('category/list', 'User\CategoryController@index');
    Route::get('test/{categoryId}/category', 'User\LessonController@showLessonTest');
    Route::post('result/{categoryId}/category', 'User\ResultController@store');
    Route::get('result/{lessonId}/lesson', 'User\ResultController@getResult');
    Route::get('word/list', 'User\WordController@showList');
    Route::post('word/filter', 'User\WordController@wordsFilter');
    Route::get('list/member', 'User\UserController@listMember');
    Route::get('add/follow/{userId}', 'User\UserController@addRelationship');
});
