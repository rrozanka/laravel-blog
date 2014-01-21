<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'App\Controllers\Index\HomeController@getIndex');
Route::controller('home', 'App\Controllers\Index\HomeController');

/**
 * routes before auth filter
 *
 */
Route::group(['prefix' => 'admin', 'before' => 'auth'], function() {
    Route::controller('index', 'App\Controllers\Admin\IndexController');
    Route::controller('settings', 'App\Controllers\Admin\SettingsController');
    Route::resource('users', 'App\Controllers\Admin\UsersController');
    Route::resource('posts', 'App\Controllers\Admin\PostsController');
    Route::resource('categories', 'App\Controllers\Admin\CategoriesController');
    Route::resource('tags', 'App\Controllers\Admin\TagsController');
    Route::resource('comments', 'App\Controllers\Admin\CommentsController', [
        'only' => ['index', 'destroy']
    ]);
    Route::get('admin/posts/index', 'App\Controllers\Admin\PostsController');
});