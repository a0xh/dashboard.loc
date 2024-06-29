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

    @stack('styles')
</head>

<body>
    <div id="ebazar-layout" class="theme-blue">

        <x-sidebar />

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

                            @include ('components.profile')
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