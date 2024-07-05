<?php

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\{View, Blade, Auth};
use Illuminate\Database\Eloquent\Model;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Domain\Role\Infrastructure\RoleRepositoryInterface::class,
            \App\Domain\Role\Infrastructure\EloquentRoleRepository::class
        );

        $this->app->bind(
            \App\Domain\User\Infrastructure\UserRepositoryInterface::class,
            \App\Domain\User\Infrastructure\EloquentUserRepository::class
        );

        $this->app->bind(
            \App\Domain\Category\Infrastructure\CategoryRepositoryInterface::class,
            \App\Domain\Category\Infrastructure\EloquentCategoryRepository::class
        );

        $this->app->bind(
            \App\Domain\Tag\Infrastructure\TagRepositoryInterface::class,
            \App\Domain\Tag\Infrastructure\EloquentTagRepository::class
        );

        $this->app->bind(
            \App\Domain\Post\Infrastructure\PostRepositoryInterface::class,
            \App\Domain\Post\Infrastructure\EloquentPostRepository::class
        );

        $this->app->bind(
            \App\Domain\Product\Infrastructure\ProductRepositoryInterface::class,
            \App\Domain\Product\Infrastructure\EloquentProductRepository::class
        );

        $this->app->bind(
            \App\Domain\Comment\Infrastructure\CommentRepositoryInterface::class,
            \App\Domain\Comment\Infrastructure\EloquentCommentRepository::class
        );

        $this->app->bind(
            \App\Domain\Page\Infrastructure\PageRepositoryInterface::class,
            \App\Domain\Page\Infrastructure\EloquentPageRepository::class
        );

        $this->app->bind(
            \App\Domain\Order\Infrastructure\OrderRepositoryInterface::class,
            \App\Domain\Order\Infrastructure\EloquentOrderRepository::class
        );

        $this->app->bind(
            \App\Domain\Subscriber\Infrastructure\SubscriberRepositoryInterface::class,
            \App\Domain\Subscriber\Infrastructure\EloquentSubscriberRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Model::shouldBeStrict();

        Blade::componentNamespace('App\\Application\\Components\\', 'admin');
        Blade::component('admin::navigation', \App\Application\Components\Navigation::class);

        View::addNamespace('admin', [app_path() . '/Infrastructure/Views']);
        View::composer(['layouts.main'], function($view) {
            $view->with('user', Auth::user());
        });
    }
}
