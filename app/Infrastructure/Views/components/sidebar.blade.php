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
                <a href="{{ route('admin.statistics.index') }}" class="m-link">
                    <i class="icofont-chart-bar-graph"></i>
                    <span>{{ __('Статистика') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.user.index') }}" class="m-link">
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
                <a href="{{ route('admin.category.index') }}" class="m-link">
                    <i class="icofont-cube"></i>
                    <span>{{ __('Категории') }}</span>
                </a>
            </li>
            <li>
                <a href="#" class="m-link">
                    <i class="icofont-ui-cart"></i>
                    <span>{{ __('Товары') }}</span>
                </a>
            </li>
            <li>
                <a href="#" class="m-link">
                    <i class="icofont-speech-comments"></i>
                    <span>{{ __('Комментарии') }}</span>
                </a>
            </li>
            <li>
                <a href="#" class="m-link">
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
                <a href="#" class="m-link">
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