<?php namespace App\Controllers;

use Acme\Post;
use Acme\Comment;
use Acme\Repositories\TagRepositoryInterface;
use Acme\Repositories\PostRepositoryInterface;
use Acme\Repositories\UserRepositoryInterface;
use Acme\Repositories\SettingRepositoryInterface;
use Acme\Repositories\CommentRepositoryInterface;
use Acme\Repositories\CategoryRepositoryInterface;

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
     * @var \Acme\Repositories\UserRepositoryInterface
     *
     */
    protected $user;

    /**
     * function construct
     *
     */
    public function __construct(CategoryRepositoryInterface $category, SettingRepositoryInterface $setting, TagRepositoryInterface $tag, CommentRepositoryInterface $comment, PostRepositoryInterface $post, UserRepositoryInterface $user)
    {
        $this->category = $category;
        $this->setting = $setting;
        $this->tag = $tag;
        $this->comment = $comment;
        $this->post = $post;
        $this->user = $user;

        \View::composer('layout-frontend', function($view)
        {
            $view->with('categories', $this->category->getAll())
                ->with('tags', $this->tag->getAll())
                ->with('about', $this->setting->getValueByKey('about'))
                ->with('authors', $this->user->getAll());
        });
    }

    /**
     * index action
     *
     */
    public function getIndex()
    {
        return \View::make('index.home.index')
            ->with('posts', Post::with('user', 'category', 'tags')->paginate(15));
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
            ->with('posts', $category->posts()->paginate(15));
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
            ->with('posts', $tag->posts()->paginate(15));
    }

    /**
     * author action
     *
     */
    public function getAuthor($id)
    {
        $author = $this->user->getById($id);

        return \View::make('index.home.author')
            ->with('author', $author)
            ->with('posts', $author->posts()->paginate(15));
    }

    /**
     * post action
     *
     */
    public function getPost($id)
    {
        $post = $this->post->getById($id);

        return \View::make('index.home.post')
            ->with('post', $post);
    }

    /**
     * search action
     *
     */
    public function getSearch()
    {
        return \View::make('index.home.search')
            ->with('posts', $this->post->search(\Input::get('q'))->paginate(15));
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

            return \Redirect::action('App\Controllers\HomeController@getPost', $post->id)
                ->with('flash_message', 'Komentarz został dodany pomyślnie.')
                ->with('flash_type', 'success');
        }
        else
        {
            return \Redirect::action('App\Controllers\HomeController@getPost', $post->id)
                ->withErrors($validator)
                ->withInput()
                ->with('flash_message', 'Wystąpiły błędy w formularzu!')
                ->with('flash_type', 'error');
        }
    }

}