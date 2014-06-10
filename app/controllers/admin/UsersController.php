<?php namespace App\Controllers\Admin;

use Acme\User;
use App\Controllers\BaseController;
use Acme\Repositories\UserRepositoryInterface;

/**
 * Class UsersController
 *
 * @package App\Controllers\Admin
 */
class UsersController extends BaseController
{

    /**
     * @var \Acme\Repositories\UserRepositoryInterface
     *
     */
    protected $user;

    /**
     * function construct
     *
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $users = $this->user->getAll();

        return \View::make('admin.users.index')
            ->withUsers($users);
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

        if ($validator->passes())
        {
            $this->user->create(\Input::all());

            return \Redirect::route('admin.users.index')
                ->with('message', 'User has been saved successfully');
        }
        else
        {
            return \Redirect::route('admin.users.create')
                ->with('message', 'The following errors occurred')
                ->with('messageType', 'danger')
                ->withErrors($validator)
                ->withInput();
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

		return \View::make('admin.users.edit')
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
        $rules = User::$rules;
        $record = User::findOrFail($id);
        $rules['email'] = 'required|email|unique:users,email,' . $record->id;
        if (trim(\Input::get('password')) == '')
        {
            $rules['password'] = 'alpha_num|between:6,12|confirmed';
            $rules['password_confirmation'] = 'alpha_num|between:6,12';
        }
        $validator = \Validator::make(\Input::all(), $rules);

        if ($validator->passes())
        {
            $this->user->update($record, \Input::all());

            return \Redirect::route('admin.users.index')
                ->with('message', 'User has been edited successfully');
        }
        else
        {
            return \Redirect::route('admin.users.edit', $record->id)
                ->with('message', 'The following errors occurred')
                ->with('messageType', 'danger')
                ->withErrors($validator)->withInput();
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
        $this->user->delete($id);
	}

}