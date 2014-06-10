<?php namespace App\Controllers;

use Acme\Post;
use Acme\Comment;
use Acme\Repositories\TagRepositoryInterface;
use Acme\Repositories\SettingRepositoryInterface;
use Acme\Repositories\CategoryRepositoryInterface;
use Acme\Repositories\CommentRepositoryInterface;
use Acme\Repositories\PostRepositoryInterface;

/**
 * Class HomeController
 *
 */
class HomeController extends BaseController
{

    /**
     * @var \Acme\Repositories\CategoryRepositoryInterface
     *
     */
    protected $category;

    /**
     * @var \Acme\Repositories\SettingRepositoryInterface
     *
     */
    protected $setting;

    /**
     * @var \Acme\Repositories\TagRepositoryInterface
     *
     */
    protected $tag;

    /**
     * @var \Acme\Repositories\CommentRepositoryInterface
     *
     */
    protected $comment;

    /**
     * @var \Acme\Repositories\PostRepositoryInterface
     *
     */
    protected $post;

    /**
     * function construct
     *
     */
    public function __construct(CategoryRepositoryInterface $category, SettingRepositoryInterface $setting, TagRepositoryInterface $tag, CommentRepositoryInterface $comment, PostRepositoryInterface $post)
    {
        $this->category = $category;
        $this->setting = $setting;
        $this->tag = $tag;
        $this->comment = $comment;
        $this->post = $post;
    }

    /**
     * index action
     *
     */
    public function getIndex()
    {
        return \View::make('index.home.index')
            ->with('posts', Post::with('user', 'category', 'tags')->paginate(15))
            ->with('categories', $this->category->getAll())
            ->with('tags', $this->tag->getAll())
            ->with('about', $this->setting->getValueByKey('about'));
    }

    /**
     * category action
     *
     */
    public function getCategory($id)
    {
        $category = $this->category->getById($id);

        return \View::make('index.home.category')
            ->with('category', $category)
            ->with('posts', $category->posts()->paginate(15))
            ->with('categories', $this->category->getAll())
            ->with('tags', $this->tag->getAll())
            ->with('about', $this->setting->getValueByKey('about'));
    }

    /**
     * tag action
     *
     */
    public function getTag($id)
    {
        $tag = $this->tag->getById($id);

        return \View::make('index.home.tag')
            ->with('tag', $tag)
            ->with('posts', $tag->posts()->paginate(15))
            ->with('categories', $this->category->getAll())
            ->with('tags', $this->tag->getAll())
            ->with('about', $this->setting->getValueByKey('about'));
    }

    /**
     * post action
     *
     */
    public function getPost($id)
    {
        $post = $this->post->getById($id);

        return \View::make('index.home.post')
            ->with('post', $post)
            ->with('categories', $this->category->getAll())
            ->with('tags', $this->tag->getAll())
            ->with('about', $this->setting->getValueByKey('about'));
    }

    /**
     * post store - save comment
     *
     */
    public function postStore($id)
    {
        $post = $this->post->getById($id);
        $validator = \Validator::make(\Input::all(), Comment::$rules);

        if ($validator->passes())
        {
            $this->comment->create($post->id, \Input::all());

            return \Redirect::action('App\Controllers\Index\HomeController@getPost', $post->id)
                ->with('message', 'Comment has been saved successfully');
        }
        else
        {
            return \Redirect::action('App\Controllers\Index\HomeController@getPost', $post->id)
                ->withErrors($validator)
                ->withInput();
        }
    }

}