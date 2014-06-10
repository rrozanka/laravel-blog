<?php namespace App\Controllers;

/**
 * Class SessionsController
 *
 */
class SessionsController extends BaseController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (\Auth::check()) {
            return \Redirect::to('admin/index');
        }

        return \View::make('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = \Input::all();
        if (\Auth::attempt(['email' => $input['email'], 'password' => $input['password']]))
        {
            return \Redirect::to('admin/index')
                ->with('flash_message', 'You have been logged in!')
                ->with('flash_type', 'success');
        }

        return \Redirect::back()
            ->with('flash_message', 'Invalid credentials')
            ->with('flash_type', 'error')
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy()
    {
        \Auth::logout();

        return \Redirect::to('/')
            ->with('flash_message', 'You have been logged out.')
            ->with('flash_type', 'information');
    }

}