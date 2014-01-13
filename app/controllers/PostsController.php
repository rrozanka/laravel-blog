<?php

namespace App\Controllers;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Utils;

/**
 * Class PostsController
 *
 */
class PostsController extends \BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $records = Post::with('user', 'category', 'tags')->get();

		return \View::make('posts.index')
            ->with('records', $records);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $categories = Utils::toSelectFormat(Category::all(), 'Select category');
        $tags = Utils::toSelectFormat(Tag::all());

		return \View::make('posts.create')
            ->with('categories', $categories)
            ->with('tags', $tags);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = \Validator::make(\Input::all(), Post::$rules);

        if ($validator->passes()) {
            $record = new Post();
            $record->name = \Input::get('name');
            $record->body = \Input::get('body');
            $record->user_id = \Auth::user()->id;
            $record->category_id = \Input::get('category');
            $record->save();

            // attach post tags
            $record->tags()->sync(\Input::get('tags', []));

            return \Redirect::route('posts.index')->with('message', 'Post has been saved successfully');
        } else {
            return \Redirect::route('posts.create')->with('message', 'The following errors occurred')->with('messageType', 'danger')->withErrors($validator)->withInput();
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $record = Post::findOrFail($id);
        $categories = Utils::toSelectFormat(Category::all(), 'Select category');
        $tags = Utils::toSelectFormat(Tag::all());
        $tagsIds = Utils::getIds($record->tags()->get());

        return \View::make('posts.edit')
            ->with('record', $record)
            ->with('categories', $categories)
            ->with('tags', $tags)
            ->with('tagsIds', $tagsIds);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $record = Post::findOrFail($id);
        $validator = \Validator::make(\Input::all(), Post::$rules);

        if ($validator->passes()) {
            $record->name = \Input::get('name');
            $record->body = \Input::get('body');
            $record->category_id = \Input::get('category');
            $record->tags()->sync(\Input::get('tags', []));
            $record->save();

            return \Redirect::route('posts.index')->with('message', 'Post has been edited successfully');
        } else {
            return \Redirect::route('posts.edit', $record->id)->with('message', 'The following errors occurred')->with('messageType', 'danger')->withErrors($validator)->withInput();
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $record = Post::findOrFail($id);
        $record->delete();
	}

}