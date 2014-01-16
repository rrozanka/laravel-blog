<?php

namespace App\Controllers;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Setting;
use App\Models\Comment;

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
            ->with('posts', Post::with('user', 'category', 'tags')->paginate(15))
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('about', Setting::getValueByKey('about'));
    }

    /**
     * category action
     *
     */
    public function getCategory($id)
    {
        $category = Category::findOrFail($id);

        return \View::make('home.category')
            ->with('category', $category)
            ->with('posts', $category->posts()->paginate(15))
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('about', Setting::getValueByKey('about'));
    }

    /**
     * tag action
     *
     */
    public function getTag($id)
    {
        $tag = Tag::findOrFail($id);

        return \View::make('home.tag')
            ->with('tag', $tag)
            ->with('posts', $tag->posts()->paginate(15))
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('about', Setting::getValueByKey('about'));
    }

    /**
     * login action
     *
     */
    public function getLogin()
    {
        if (\Auth::check()) {
            return \Redirect::to('admin/index');
        }

        return \View::make('home.login');
    }

    /**
     * login action
     *
     */
    public function postLogin()
    {
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
    public function getLogout()
    {
        \Auth::logout();
        return \Redirect::to('/')->with('message', 'Your are now logged out!')->with('messageType', 'info');
    }

    /**
     * post action
     *
     */
    public function getPost($id)
    {
        $post = Post::findOrFail($id);

        return \View::make('home.post')
            ->with('post', $post)
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('about', Setting::getValueByKey('about'));
    }

    /**
     * post store - save comment
     *
     */
    public function postStore($id)
    {
        $post = Post::findOrFail($id);
        $validator = \Validator::make(\Input::all(), Comment::$rules);

        if ($validator->passes()) {
            $record = new Comment();
            $record->name = \Input::get('name');
            $record->email = \Input::get('email');
            $record->body = \Input::get('body');
            $record->post_id = $post->id;
            $record->save();

            return \Redirect::action('App\Controllers\HomeController@getPost', $post->id)->with('message', 'Comment has been saved successfully');
        } else {
            return \Redirect::action('App\Controllers\HomeController@getPost', $post->id)->withErrors($validator)->withInput();
        }
    }

}