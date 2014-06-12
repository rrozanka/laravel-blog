<?php namespace App\Controllers;

use Acme\Repositories\CategoryRepositoryInterface;
use Acme\Repositories\SettingRepositoryInterface;
use Acme\Repositories\TagRepositoryInterface;
use Acme\Repositories\UserRepositoryInterface;

/**
 * Class SessionsController
 *
 */
class SessionsController extends BaseController
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
     * @var \Acme\Repositories\UserRepositoryInterface
     *
     */
    protected $user;

    /**
     * function construct
     *
     */
    public function __construct(CategoryRepositoryInterface $category, SettingRepositoryInterface $setting, TagRepositoryInterface $tag, UserRepositoryInterface $user)
    {
        $this->category = $category;
        $this->setting = $setting;
        $this->tag = $tag;
        $this->user = $user;

        \View::composer('layout-frontend', function($view)
        {
            $view->with('categories', $this->category->getAll())
                ->with('tags', $this->tag->getAll())
                ->with('about', $this->setting->getValueByKey('about'))
                ->with('authors', $this->user->getAll())
                ->with('hideSidebar', true);
        });
    }

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
                ->with('flash_message', 'Zostałeś pomyślnie zalogowany.')
                ->with('flash_type', 'success');
        }

        return \Redirect::back()
            ->with('flash_message', 'Wystąpiły błędy w formularzu!')
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
            ->with('flash_message', 'Zostałeś pomyślnie wylogowany.')
            ->with('flash_type', 'success');
    }

}