<?php

namespace App\Controllers\Admin;
use App\Models\Category;

/**
 * Class CategoriesController
 *
 */
class CategoriesController extends \BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $records = Category::all();

        return \View::make('admin.categories.index')
            ->with('records', $records);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return \View::make('admin.categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = \Validator::make(\Input::all(), Category::$rules);

        if ($validator->passes()) {
            $record = new Category();
            $record->name = \Input::get('name');
            $record->save();

            return \Redirect::route('admin.categories.index')->with('message', 'Category has been saved successfully');
        } else {
            return \Redirect::route('admin.categories.create')->with('message', 'The following errors occurred')->with('messageType', 'danger')->withErrors($validator)->withInput();
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
        $record = Category::findOrFail($id);

        return \View::make('admin.categories.edit')
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
        $record = Category::findOrFail($id);
        $validator = \Validator::make(\Input::all(), Category::$rules);

        if ($validator->passes()) {
            $record->name = \Input::get('name');
            $record->save();

            return \Redirect::route('admin.categories.index')->with('message', 'Category has been edited successfully');
        } else {
            return \Redirect::route('admin.categories.edit', $record->id)->with('message', 'The following errors occurred')->with('messageType', 'danger')->withErrors($validator)->withInput();
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
        $record = Category::findOrFail($id);
        $record->delete();
	}

}