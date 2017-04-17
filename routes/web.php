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

//Route for user
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('', 'User\HomeController@index');
    Route::get('profile', 'User\UserController@showProfile');
    Route::get('profile/edit', 'User\UserController@editProfile');
    Route::PATCH('profile/update', 'User\UserController@updateProfile');
    Route::get('category/list', 'User\CategoryController@index');
    Route::get('lesson/create/{id}', 'User\LessonController@index');
});
