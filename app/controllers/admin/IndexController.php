<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * Class IndexController
 *
 * @package App\Controllers\Admin
 */
class IndexController extends BaseController {

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