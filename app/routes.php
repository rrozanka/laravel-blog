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

Route::get('/', 'App\Controllers\HomeController@getIndex');
Route::controller('home', 'App\Controllers\HomeController');

/**
 * routes before auth filter
 *
 */
Route::group(['before' => 'auth'], function() {
    Route::controller('admin', 'App\Controllers\AdminController');
    Route::controller('settings', 'App\Controllers\SettingsController');
    Route::resource('users', 'App\Controllers\UsersController');
    Route::resource('posts', 'App\Controllers\PostsController');
    Route::resource('categories', 'App\Controllers\CategoriesController');
    Route::resource('tags', 'App\Controllers\TagsController');
    Route::resource('comments', 'App\Controllers\CommentsController', [
        'only' => ['index', 'destroy']
    ]);
});