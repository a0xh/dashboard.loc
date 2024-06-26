<?php

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Domain\Role\Infrastructure\RoleRepositoryInterface::class,
            \App\Domain\Role\Infrastructure\CachedRoleRepository::class
        );

        $this->app->bind(
            \App\Domain\User\Infrastructure\UserRepositoryInterface::class,
            \App\Domain\User\Infrastructure\CachedUserRepository::class
        );

        $this->app->bind(
            \App\Domain\Category\Infrastructure\CategoryRepositoryInterface::class,
            \App\Domain\Category\Infrastructure\CachedCategoryRepository::class
        );

        $this->app->bind(
            \App\Domain\Tag\Infrastructure\TagRepositoryInterface::class,
            \App\Domain\Tag\Infrastructure\CachedTagRepository::class
        );

        $this->app->bind(
            \App\Domain\Post\Infrastructure\PostRepositoryInterface::class,
            \App\Domain\Post\Infrastructure\CachedPostRepository::class
        );

        $this->app->bind(
            \App\Domain\Product\Infrastructure\ProductRepositoryInterface::class,
            \App\Domain\Product\Infrastructure\CachedProductRepository::class
        );

        $this->app->bind(
            \App\Domain\Comment\Infrastructure\CommentRepositoryInterface::class,
            \App\Domain\Comment\Infrastructure\CachedCommentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Model::shouldBeStrict();

        View::addNamespace('admin', [
            app_path() . '/Infrastructure/Views',
        ]);

        view()->composer(['layouts.main'], function($view) {
            $view->with('user', Auth::user());
        });
    }
}
