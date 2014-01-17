<?php

namespace App\Controllers\Admin;
use App\Models\User;

/**
 * Class UsersController
 *
 */
class UsersController extends \BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $records = User::all();

        return \View::make('admin.users.index')
            ->with('records', $records);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return \View::make('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = \Validator::make(\Input::all(), User::$rules);

        if ($validator->passes()) {
            $record = new User();
            $record->firstname = \Input::get('firstname');
            $record->lastname = \Input::get('lastname');
            $record->email = \Input::get('email');
            $record->password = \Hash::make(\Input::get('password'));
            $record->save();

            return \Redirect::route('admin.users.index')->with('message', 'User has been saved successfully');
        } else {
            return \Redirect::route('admin.users.create')->with('message', 'The following errors occurred')->with('messageType', 'danger')->withErrors($validator)->withInput();
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
        $record = User::findOrFail($id);

		return \View::make('admin.users.edit')->with('record', $record);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $rules = User::$rules;
        $record = User::findOrFail($id);
        $rules['email'] = 'required|email|unique:users,email,' . $record->id;
        if (trim(\Input::get('password')) == '') {
            $rules['password'] = 'alpha_num|between:6,12|confirmed';
            $rules['password_confirmation'] = 'alpha_num|between:6,12';
        }
        $validator = \Validator::make(\Input::all(), $rules);

        if ($validator->passes()) {
            $record->firstname = \Input::get('firstname');
            $record->lastname = \Input::get('lastname');
            $record->email = \Input::get('email');
            if (trim(\Input::get('password')) != '') {
                $record->password = \Hash::make(\Input::get('password'));
            }
            $record->save();

            return \Redirect::route('admin.users.index')->with('message', 'User has been edited successfully');
        } else {
            return \Redirect::route('admin.users.edit', $record->id)->with('message', 'The following errors occurred')->with('messageType', 'danger')->withErrors($validator)->withInput();
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
        $record = User::findOrFail($id);
        $record->delete();
	}

}