<?php

namespace App\Controllers\Admin;

/**
 * Class IndexController
 *
 */
class IndexController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        return \View::make('admin.index.index');
	}

}