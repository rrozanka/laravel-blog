<?php namespace App\Controllers\Admin;

use Acme\Tag;
use Acme\Post;
use Acme\Category;
use App\Models\Utils;
use App\Controllers\BaseController;
use Acme\Repositories\PostRepositoryInterface;

/**
 * Class PostsController
 *
 */
class PostsController extends BaseController
{

    /**
     * @var \Acme\Repositories\PostRepositoryInterface
     *
     */
    protected $post;

    /**
     * function construct
     *
     */
    public function __construct(PostRepositoryInterface $post)
    {
        $this->post = $post;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $posts = Post::with('user', 'category')->get();

		return \View::make('admin.posts.index')
            ->withPosts($posts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $categories = Utils::toSelectFormat(Category::all(), 'Select category');
        $tags = Utils::toSelectFormat(Tag::all());

        return \View::make('admin.posts.create')
            ->withCategories($categories)
            ->withTags($tags);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = \Validator::make(\Input::all(), Post::$rules);

        if ($validator->passes())
        {
            $record = $this->post->create(\Input::all());
            $record->tags()->sync(\Input::get('tags', []));

            return \Redirect::route('admin.posts.index')
                ->with('message', 'Post has been saved successfully');
        }
        else
        {
            return \Redirect::route('admin.posts.create')
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
        $record = $this->post->getById($id);
        $categories = Utils::toSelectFormat(Category::all(), 'Select category');
        $tags = Utils::toSelectFormat(Tag::all());
        $tagsIds = Utils::getIds($record->tags()->get());

        return \View::make('admin.posts.edit')
            ->with('record', $record)
            ->with('categories', $categories)
            ->with('tags', $tags)
            ->with('tagsIds', $tagsIds);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $record = Post::findOrFail($id);
        $validator = \Validator::make(\Input::all(), Post::$rules);

        if ($validator->passes())
        {
            $this->post->update($record, \Input::all());
            $record->tags()->sync(\Input::get('tags', []));

            return \Redirect::route('admin.posts.index')
                ->with('message', 'Post has been edited successfully');
        }
        else
        {
            return \Redirect::route('admin.posts.edit', $record->id)
                ->with('message', 'The following errors occurred')
                ->with('messageType', 'danger')
                ->withErrors($validator)
                ->withInput();
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
        $this->post->delete($id);
	}

}