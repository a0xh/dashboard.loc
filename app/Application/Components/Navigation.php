<?php

namespace App\Application\Components;

use Closure;
use Illuminate\Contracts\View\View;
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
        return Blade::render('<x-admin::navigation :routes="$routes" />', [
            'routes' => $this->registerRoutes()
        ]);
    }

    private function registerRoutes(): array
    {
        return [
            [
                'name' => 'Статистика',
                'active' => $this->isActiveRoute('admin.statistics.index'),
                'path' => route('admin.statistics.index'),
            ],
            [
                'name' => 'Пользователи',
                'active' => $this->isActiveRoute('admin.user.index'),
                'path' => route('admin.user.index'),
            ],
            [
                'name' => 'Заказы',
                'active' => $this->isActiveRoute('admin.order.index'),
                'path' => route('admin.order.index'),
            ],
            [
                'name' => 'Категории',
                'active' => $this->isActiveRoute('admin.category.index'),
                'path' => route('admin.category.index'),
            ],
            [
                'name' => 'Товары',
                'active' => $this->isActiveRoute('admin.product.index'),
                'path' => route('admin.product.index'),
            ],
            [
                'name' => 'Комментарии',
                'active' => $this->isActiveRoute('admin.comment.index'),
                'path' => route('admin.comment.index'),
            ],
            [
                'name' => 'Посты',
                'active' => $this->isActiveRoute('admin.post.index'),
                'path' => route('admin.post.index'),
            ],
            [
                'name' => 'Подписчики',
                'active' => $this->isActiveRoute('admin.subscriber.index'),
                'path' => route('admin.subscriber.index'),
            ],
            [
                'name' => 'Теги',
                'active' => $this->isActiveRoute('admin.tag.index'),
                'path' => route('admin.tag.index'),
            ],
            [
                'name' => 'Инструменты',
                'active' => $this->isActiveRoute('admin.tool.index'),
                'path' => route('admin.tool.index'),
            ],
            [
                'name' => 'Настройки',
                'active' => $this->isActiveRoute('admin.setting.index'),
                'path' => route('admin.setting.index'),
            ],
        ];
    }

    private function isActiveRoute(string $path): bool
    {
        return $this->request->routeIs($path);
    }
}
