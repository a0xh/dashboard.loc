<div class="sidebar px-4 py-4 py-md-4 me-0">
    <div class="d-flex flex-column h-100">
        <a href="{{ route('admin.statistics.index') }}" class="mb-0 brand-icon">
            <span class="logo-icon">
                <i class="icofont-skull-face fs-2"></i>
            </span>
            <span class="logo-text">{{ trans('PHPlander') }}</span>
        </a>

        <ul class="menu-list flex-grow-1 mt-3">
            <li>
                <a href="{{ route('admin.statistics.index') }}" @class([
                    'active m-link' => Route::is('admin.statistics.index'),
                    'm-link' => !Route::is('admin.statistics.index')
                ])>
                    <i class="icofont-chart-bar-graph"></i>
                    <span>{{ __('Статистика') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.user.index') }}" @class([
                    'active m-link' => Route::is('admin.user.index'),
                    'm-link' => !Route::is('admin.user.index')
                ])>
                    <i class="icofont-users-alt-2"></i>
                    <span>{{ __('Пользователи') }}</span>
                </a>
            </li>
            <li>
                <a href="#" class="m-link">
                    <i class="icofont-money-bag"></i>
                    <span>{{ __('Заказы') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.category.index') }}" @class([
                    'active m-link' => Route::is('admin.category.index'),
                    'm-link' => !Route::is('admin.category.index')
                ])>
                    <i class="icofont-cube"></i>
                    <span>{{ __('Категории') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.product.index') }}" class="m-link" @class([
                    'active m-link' => Route::is('admin.product.index'),
                    'm-link' => !Route::is('admin.product.index')
                ])>
                    <i class="icofont-ui-cart"></i>
                    <span>{{ __('Товары') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.comment.index') }}" @class([
                    'active m-link' => Route::is('admin.comment.index'),
                    'm-link' => !Route::is('admin.comment.index')
                ])>
                    <i class="icofont-speech-comments"></i>
                    <span>{{ __('Комментарии') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.post.index') }}" @class([
                    'active m-link' => Route::is('admin.post.index'),
                    'm-link' => !Route::is('admin.post.index')
                ])>
                    <i class="icofont-paper"></i>
                    <span>{{ __('Посты') }}</span>
                </a>
            </li>
            <li>
                <a href="#" class="m-link">
                    <i class="icofont-ui-email"></i>
                    <span>{{ __('Подписчики') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.tag.index') }}" @class([
                    'active m-link' => Route::is('admin.tag.index'),
                    'm-link' => !Route::is('admin.tag.index')
                ])>
                    <i class="icofont-tags"></i>
                    <span>{{ __('Теги') }}</span>
                </a>
            </li>
            <li>
                <a href="#" class="m-link">
                    <i class="icofont-education"></i>
                    <span>{{ __('Страницы') }}</span>
                </a>
            </li>
            <li href="#" class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#tools">
                    <i class="icofont-tools-alt-2"></i>
                    <span>{{ __('Инструменты') }}</span>
                    <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
                </a>
                <ul class="sub-menu collapse" id="tools"><li>
                        <a href="#" class="ms-link">
                            <span>{{ __('— robots.txt') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="ms-link">
                            <span>{{ __('— sitemap.xml') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="ms-link">
                            <span>{{ __('— .htaccess') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="m-link">
                    <i class="icofont-ui-settings"></i>
                    <span>{{ __('Настройки') }}</span>
                </a>
            </li>
        </ul>
        <button type="button" class="btn btn-link sidebar-mini-btn text-light">
            <span class="ms-2">
                <i class="icofont-bubble-right"></i>
            </span>
        </button>
    </div>
</div>