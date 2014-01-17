<?php

namespace App\Controllers\Admin;
use App\Models\Comment;

/**
 * Class CommentsController
 *
 */
class CommentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$comments = Comment::with('post')->get();

        return \View::make('admin.comments.index')
            ->with('records', $comments);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $record = Comment::findOrFail($id);
        $record->delete();
	}

}