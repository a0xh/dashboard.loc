<?php

namespace App\Application\Components;

use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;

class Navigation extends Component
{
    public function __construct(private Request $request) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): \Illuminate\View\View
    {
        return View::make('admin::components.navigation');
        // return View::make('admin::components.navigation', [
        //     'routes' => $this->registerRoutes()
        // ]);
    }

    private function registerRoutes(): array
    {
        return [
            [
                'name' => 'Статистика',
                'active' => $this->isActiveRoute('admin.statistics.index'),
                'link' => route('admin.statistics.index'),
            ],
            [
                'name' => 'Пользователи',
                'active' => $this->isActiveRoute('admin.user.index'),
                'link' => route('admin.user.index'),
            ],
            [
                'name' => 'Заказы',
                'active' => $this->isActiveRoute('admin.order.index'),
                'link' => route('admin.order.index'),
            ],
            [
                'name' => 'Категории',
                'active' => $this->isActiveRoute('admin.category.index'),
                'link' => route('admin.category.index'),
            ],
            [
                'name' => 'Товары',
                'active' => $this->isActiveRoute('admin.product.index'),
                'link' => route('admin.product.index'),
            ],
            [
                'name' => 'Комментарии',
                'active' => $this->isActiveRoute('admin.comment.index'),
                'link' => route('admin.comment.index'),
            ],
            [
                'name' => 'Посты',
                'active' => $this->isActiveRoute('admin.post.index'),
                'link' => route('admin.post.index'),
            ],
            [
                'name' => 'Подписчики',
                'active' => $this->isActiveRoute('admin.subscriber.index'),
                'link' => route('admin.subscriber.index'),
            ],
            [
                'name' => 'Теги',
                'active' => $this->isActiveRoute('admin.tag.index'),
                'link' => route('admin.tag.index'),
            ],
            [
                'name' => 'Инструменты',
                'active' => $this->isActiveRoute('admin.tool.index'),
                'link' => route('admin.tool.index'),
            ],
            [
                'name' => 'Настройки',
                'active' => $this->isActiveRoute('admin.setting.index'),
                'link' => route('admin.setting.index'),
            ],
        ];
    }

    private function isActiveRoute(string $link): bool
    {
        return $this->request->routeIs($link);
    }
}
