<?php namespace Acme\Repositories;

use Illuminate\Support\ServiceProvider;

/**
 * Class BackendServiceProvider
 *
 * @package Acme\Repositories
 */
class BackendServiceProvider extends ServiceProvider
{

    /**
     * function register
     *
     */
    public function register()
    {
        $this->app->bind(
            'Acme\Repositories\UserRepositoryInterface',
            'Acme\Repositories\DbUserRepository'
        );

        $this->app->bind(
            'Acme\Repositories\CategoryRepositoryInterface',
            'Acme\Repositories\DbCategoryRepository'
        );

        $this->app->bind(
            'Acme\Repositories\TagRepositoryInterface',
            'Acme\Repositories\DbTagRepository'
        );

        $this->app->bind(
            'Acme\Repositories\PostRepositoryInterface',
            'Acme\Repositories\DbPostRepository'
        );

        $this->app->bind(
            'Acme\Repositories\SettingRepositoryInterface',
            'Acme\Repositories\DbSettingRepository'
        );

        $this->app->bind(
            'Acme\Repositories\CommentRepositoryInterface',
            'Acme\Repositories\DbCommentRepository'
        );
    }

}