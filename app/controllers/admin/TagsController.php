<?php

namespace App\Controllers\Admin;
use App\Models\Tag;

/**
 * Class TagsController
 *
 */
class TagsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $tags = Tag::all();

        return \View::make('admin.tags.index')
            ->with('records', $tags);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return \View::make('admin.tags.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = \Validator::make(\Input::all(), Tag::$rules);

        if ($validator->passes()) {
            $record = new Tag();
            $record->name = \Input::get('name');
            $record->save();

            return \Redirect::route('admin.tags.index')->with('message', 'Tag has been saved successfully');
        } else {
            return \Redirect::route('admin.tags.create')->with('message', 'The following errors occurred')->with('messageType', 'danger')->withErrors($validator)->withInput();
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $record = Tag::findOrFail($id);

        return \View::make('admin.tags.edit')
            ->with('record', $record);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $record = Tag::findOrFail($id);
        $validator = \Validator::make(\Input::all(), Tag::$rules);

        if ($validator->passes()) {
            $record->name = \Input::get('name');
            $record->save();

            return \Redirect::route('admin.tags.index')->with('message', 'Tag has been edited successfully');
        } else {
            return \Redirect::route('admin.tags.edit', $record->id)->with('message', 'The following errors occurred')->with('messageType', 'danger')->withErrors($validator)->withInput();
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
        $record = Tag::findOrFail($id);
        $record->delete();
	}

}
