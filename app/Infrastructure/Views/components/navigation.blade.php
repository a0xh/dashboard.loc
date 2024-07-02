<div class="sidebar px-4 py-4 py-md-4 me-0">
    <div class="d-flex flex-column h-100">
        @if (Route::has('admin.statistics.index'))
            <a href="{{ route('admin.statistics.index') }}" class="mb-0 brand-icon">
                <span class="logo-icon">
                    <i class="icofont-skull-face fs-2"></i>
                </span>
                <span class="logo-text">{{ trans('PHPlander') }}</span>
            </a>
        @endif

        <ul class="menu-list flex-grow-1 mt-3">
            @if (Route::has('admin.statistics.index'))
                <li>
                    <a href="{{ route('admin.statistics.index') }}" @class([
                        'active m-link' => Route::is('admin.statistics.index'),
                        'm-link' => !Route::is('admin.statistics.index')
                    ])>
                        <i class="icofont-chart-bar-graph"></i>
                        <span>@lang('messages.admin.statistics.index')</span>
                    </a>
                </li>
            @endif

            @if (Route::has('admin.user.index'))
                <li>
                    <a href="{{ route('admin.user.index') }}" @class([
                        'active m-link' => Route::is('admin.user.index'),
                        'm-link' => !Route::is('admin.user.index')
                    ])>
                        <i class="icofont-users-alt-2"></i>
                        <span>@lang('messages.admin.user.index')</span>
                    </a>
                </li>
            @endif

            @if (Route::has('admin.order.index'))
                <li>
                    <a href="{{ route('admin.order.index') }}" @class([
                        'active m-link' => Route::is('admin.order.index'),
                        'm-link' => !Route::is('admin.order.index')
                    ])>
                        <i class="icofont-money-bag"></i>
                        <span>@lang('messages.admin.order.index')</span>
                    </a>
                </li>
            @endif

            @if (Route::has('admin.category.index'))
                <li>
                    <a href="{{ route('admin.category.index') }}" @class([
                        'active m-link' => Route::is('admin.category.index'),
                        'm-link' => !Route::is('admin.category.index')
                    ])>
                        <i class="icofont-cube"></i>
                        <span>@lang('messages.admin.category.index')</span>
                    </a>
                </li>
            @endif

            @if (Route::has('admin.product.index'))
                <li>
                    <a href="{{ route('admin.product.index') }}" @class([
                        'active m-link' => Route::is('admin.product.index'),
                        'm-link' => !Route::is('admin.product.index')
                    ])>
                        <i class="icofont-ui-cart"></i>
                        <span>@lang('messages.admin.product.index')</span>
                    </a>
                </li>
            @endif

            @if (Route::has('admin.comment.index'))
                <li>
                    <a href="{{ route('admin.comment.index') }}" @class([
                        'active m-link' => Route::is('admin.comment.index'),
                        'm-link' => !Route::is('admin.comment.index')
                    ])>
                        <i class="icofont-speech-comments"></i>
                        <span>@lang('messages.admin.comment.index')</span>
                    </a>
                </li>
            @endif

            @if (Route::has('admin.post.index'))
                <li>
                    <a href="{{ route('admin.post.index') }}" @class([
                        'active m-link' => Route::is('admin.post.index'),
                        'm-link' => !Route::is('admin.post.index')
                    ])>
                        <i class="icofont-paper"></i>
                        <span>@lang('messages.admin.post.index')</span>
                    </a>
                </li>
            @endif

            @if (Route::has('admin.subscriber.index'))
                <li>
                    <a href="{{ route('admin.subscriber.index') }}" @class([
                        'active m-link' => Route::is('admin.subscriber.index'),
                        'm-link' => !Route::is('admin.subscriber.index')
                    ])>
                        <i class="icofont-ui-email"></i>
                        <span>@lang('messages.admin.subscriber.index')</span>
                    </a>
                </li>
            @endif

            @if (Route::has('admin.tag.index'))
                <li>
                    <a href="{{ route('admin.tag.index') }}" @class([
                        'active m-link' => Route::is('admin.tag.index'),
                        'm-link' => !Route::is('admin.tag.index')
                    ])>
                        <i class="icofont-tags"></i>
                        <span>@lang('messages.admin.tag.index')</span>
                    </a>
                </li>
            @endif

            @if (Route::has('admin.page.index'))
                <li>
                    <a href="{{ route('admin.page.index') }}" @class([
                        'active m-link' => Route::is('admin.page.index'),
                        'm-link' => !Route::is('admin.page.index')
                    ])>
                        <i class="icofont-education"></i>
                        <span>@lang('messages.admin.page.index')</span>
                    </a>
                </li>
            @endif

            <li href="javascript:void(0);" class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#tools">
                    <i class="icofont-tools-alt-2"></i>
                    <span>@lang('messages.admin.tool.index')</span>
                    <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
                </a>

                <ul class="sub-menu collapse" id="tools">
                    @if (Route::has('admin.tool.robots.index'))
                        <li>
                            <a href="{{ route('admin.tool.robots.index') }}" @class([
                                'active ms-link' => Route::is('admin.tool.robots.index'),
                                'ms-link' => !Route::is('admin.tool.robots.index')
                            ])>
                                <span>@lang('messages.admin.tool.robots.index')</span>
                            </a>
                        </li>
                    @endif

                    @if (Route::has('admin.tool.sitemap.index'))
                        <li>
                            <a href="{{ route('admin.tool.sitemap.index') }}" @class([
                                'active ms-link' => Route::is('admin.tool.sitemap.index'),
                                'ms-link' => !Route::is('admin.tool.sitemap.index')
                            ])>
                                <span>@lang('messages.admin.tool.sitemap.index')</span>
                            </a>
                        </li>
                    @endif

                    @if (Route::has('admin.tool.htaccess.index'))
                        <li>
                            <a href="{{ route('admin.tool.htaccess.index') }}" @class([
                                'active ms-link' => Route::is('admin.tool.htaccess.index'),
                                'ms-link' => !Route::is('admin.tool.htaccess.index')
                            ])>
                                <span>@lang('messages.admin.tool.htaccess.index')</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            @if (Route::has('admin.setting.index'))
                <li>
                    <a href="{{ route('admin.setting.index') }}" class="m-link" @class([
                        'active m-link' => Route::is('admin.setting.index'),
                        'm-link' => !Route::is('admin.setting.index')
                    ])>
                        <i class="icofont-ui-settings"></i>
                        <span>@lang('messages.admin.setting.index')</span>
                    </a>
                </li>
            @endif
        </ul>

        <button type="button" class="btn btn-link sidebar-mini-btn text-light">
            <span class="ms-2"><i class="icofont-bubble-right"></i></span>
        </button>
    </div>
</div>