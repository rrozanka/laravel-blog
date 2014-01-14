<?php

namespace App\Controllers;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Setting;

/**
 * Class HomeController
 *
 */
class HomeController extends \BaseController
{

    /**
     * index action
     *
     */
    public function getIndex()
    {
        return \View::make('home.index')
            ->with('posts', Post::with('user', 'category', 'tags')->paginate(1))
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('about', Setting::getValueByKey('about'));
    }

    /**
     * login action
     *
     */
    public function getLogin() {
        if (\Auth::check()) {
            return \Redirect::to('admin/index');
        }

        return \View::make('home.login');
    }

    /**
     * login action
     *
     */
    public function postLogin() {
        if (\Auth::attempt(array('email' => \Input::get('email'), 'password' => \Input::get('password')))) {
            return \Redirect::to('admin/index')->with('message', 'You are now logged in!')->with('messageType', 'success');
        } else {
            return \Redirect::to('home/login')
                ->with('message', 'Your username/password combination was incorrect')
                ->with('messageType', 'danger')
                ->withInput();
        }
    }

    /**
     * logout action
     *
     */
    public function getLogout() {
        \Auth::logout();
        return \Redirect::to('/')->with('message', 'Your are now logged out!')->with('messageType', 'info');
    }

}