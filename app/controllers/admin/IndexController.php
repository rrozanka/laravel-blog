<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * Class IndexController
 *
 */
class IndexController extends BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        return \Redirect::route('admin.posts.index');
	}

}