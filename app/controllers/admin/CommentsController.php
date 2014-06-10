<?php namespace App\Controllers\Admin;

use Acme\Comment;
use App\Controllers\BaseController;
use Acme\Repositories\CommentRepositoryInterface;

/**
 * Class CommentsController
 *
 */
class CommentsController extends BaseController
{

    /**
     * @var \Acme\Repositories\CommentRepositoryInterface
     *
     */
    protected $comment;

    /**
     * function construct
     *
     */
    public function __construct(CommentRepositoryInterface $comment)
    {
        $this->comment = $comment;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$comments = Comment::with('post')->get();

        return \View::make('admin.comments.index')
            ->withComments($comments);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $this->comment->delete($id);
	}

}