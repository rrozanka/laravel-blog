<?php

namespace App\Controllers;
use App\Models\Post;

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
        $records = Post::with('user')->get();

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
		return \View::make('posts.create');
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
            $record->save();

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

        return \View::make('posts.edit')->with('record', $record);
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