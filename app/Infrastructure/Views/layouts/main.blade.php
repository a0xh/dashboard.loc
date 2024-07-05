<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title') | {{ trans('PHPlander') }}</title>

    {{-- Favicons --}}
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon.png') }}" />
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" sizes="192x192" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicon.png') }}" />

    {{-- <script src="{{ asset('assets/js/htmx.min.js') }}"></script> --}}

    @stack('styles')
</head>

<body hx-boost="true">
    <div id="ebazar-layout" class="theme-blue">

        <x-admin::navigation />

        <div class="main px-lg-4 px-md-4">
            <div class="header">
                <nav class="navbar py-4">
                    <div class="container-xxl">

                        <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">
                            <div class="d-flex">
                                <a href="#" target="_blank" rel="noreferrer" class="nav-link text-primary collapsed">
                                    {{ __('Перейти на сайт →') }}
                                </a>
                            </div>

                            <x-lang />

                            <div class="dropdown notifications">
                                <x-notification />
                            </div>

                            <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                                <div class="u-info me-2">
                                    <p class="mb-0 text-end line-height-sm">
                                        <span class="font-weight-bold">{{ $user->name ?? null }}</span>
                                    </p>

                                    <small>{{ __('Admin') }}</small>
                                </div>
                                
                                <a href="javascript:void(0);" class="nav-link dropdown-toggle pulse p-0" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                                    <img src="{{ Storage::url($user->media) }}" class="avatar lg rounded-circle img-thumbnail">
                                </a>

                                <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                    <div class="card border-0 w280">

                                        <div class="card-body pb-0">
                                            <div class="d-flex py-1">
                                                <img class="avatar rounded-circle" src="{{ Storage::url($user->media) }}">
                                                <div class="flex-fill ms-3">
                                                    <p class="mb-0">
                                                        <span class="font-weight-bold">
                                                            {{ $user->first_name ?? null }}
                                                            {{ $user->last_name ?? null }}
                                                        </span>
                                                    </p>
                                                    <small>{{ $user->email ?? null }}</small>
                                                </div>
                                            </div>
                                            
                                            <div><hr class="dropdown-divider border-dark"></div>
                                        </div>

                                        <div class="list-group m-2">
                                            <a href="#" class="list-group-item list-group-item-action border-0">
                                                <i class="icofont-ui-user fs-5 me-3"></i>
                                                {{ __('Профиль') }}
                                            </a>

                                            <a href="#" class="list-group-item list-group-item-action border-0">
                                                <i class="icofont-ui-settings fs-5 me-3"></i>
                                                {{ __('Настройки') }}
                                            </a>

                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action border-0">
                                                <i class="icofont-logout fs-5 me-3"></i>
                                                {{ __('Выход') }}
                                            </a>
                                            
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                            <span class="fa fa-bars"></span>
                        </button>

                        <x-search />

                    </div>
                </nav>
            </div>
            
            @yield('content')

        </div>

    </div>

    @stack('scripts')
</body>
</html>