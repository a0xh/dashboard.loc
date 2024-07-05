@extends('layouts.main')

@section('title', trans('messages.admin.setting.index'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">

            <x-success />
            <x-errors />
            <x-message />

            <div class="row clearfix">
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 flex-lg-column">
                    <div class="sticky-lg-top">
                        <div class="row row-deck">

                            <div class="col-12 col-sm-6 col-md-6 col-lg-12 flex-column">
                                <div class="card mb-3">
                                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                                        <div class="preview-pane text-center">
                                            <svg width="100" fill="currentColor" class="bi bi-telegram text-primary" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"></path>
                                            </svg>
                                            <a href="{{ __('https://t.me/stackphp') }}" rel="noopener noreferrer nofollow" target="_blank" class="fw-bold fs-6 mt-2 d-flex justify-content-center color-defult">{{ __('@phpstack') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-6 col-lg-12 flex-column">
                                <div class="card mb-3">
                                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                                        <div class="preview-pane text-center">
                                            <svg width="100" fill="currentColor" class="bi bi-envelope text-primary" viewBox="0 0 16 16">
                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                                            </svg>
                                            <a href="mailto:{{ __('a0xh@4ifi.ru') }}" rel="noopener noreferrer nofollow" target="_blank" class="fs-6 mt-2 d-flex justify-content-center color-defult">{{ __('a0xh@4ifi.ru') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12">
                    <div class="card border-0">
                        <div class="card-header py-2">
                            <h4 class="display-6 fw-bold">@yield('title')</h4>
                        </div>

                        <div class="card-body">
                            <div class="mb-4 overflow-hidden">
                                <div class="bg-primary py-5 px-4 text-light">
                                    <h4>{{ __('PHPlander.com') }}</h4>
                                    <span>{{ __('Руководство по настройке') }}</span>
                                </div>

                                <div class="p-4">
                                    <p class="fw-bold">{{ __('Основные настройки') }}</p>
                                    <span>{{ __('Исходя из этих данных происходит настройка SEO, поэтому не откладывайте их заполнение.') }}</span>
                                    <form method="post" action="" class="mt-4 mb-2">

                                        @csrf
                                        @include('setting.partials._default-form')
                                        
                                        <div class="mt-4 mb-2">
                                            <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                                        </div>
                                    </form>

                                    <hr>

                                    <p class="fw-bold">{{ __('Настройки базы данных') }}</p>
                                    <span>{{ __('Заполняйте эти данные исключительно корректно, иначе уроните и сайт, и саму панельку.') }}</span>
                                    <form method="post" action="" class="mt-4 mb-2">

                                        @csrf
                                        @include('setting.partials._database-form')
                                        
                                        <div class="mt-4 mb-2">
                                            <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                                        </div>
                                    </form>

                                    <hr>

                                    <span class="text-muted">{!! __('Благодарю за использование <strong class="text-warning">PHPlander</strong> и желаю вам успехов!') !!}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
@endpush