@extends('layouts.main')

@section('title', trans('messages.admin.comment.index'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">

            <x-heading>
                <x-slot:button>
                    <ul class="nav nav-tabs tab-body-header rounded invoice-set" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#post" role="tab">{{ __('Комментарии постов') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#product" role="tab">{{ __('Комментарии товаров') }}</a>
                        </li>
                    </ul>
                </x-slot>
            </x-heading>

            <x-success />
            <x-errors />
            <x-message />

            <div class="tab-content">
                <div id="post" class="tab-pane fade show active">
                    @isset ($commentsTypePost)
                        <div class="row clearfix g-3">
                            <div class="col-sm-12">
                                <ul class="list-unstyled mb-4">
                                    @foreach ($commentsTypePost as $comment)
                                        @includeIf('comment.partials._table')
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <x-no-data>
                            <x-slot:button>
                                @if (Route::has('admin.statistics.index'))
                                    <a href="{{ route('admin.statistics.index') }}" class="btn btn-primary border lift mt-1">{{ __('Вернутся на главную') }}</a>
                                @endif
                            </x-slot>
                        </x-no-data>
                    @endisset
                </div>

                <div id="product" class="tab-pane fade">
                    @isset ($commentsTypeProduct)
                        <div class="row clearfix g-3">
                            <div class="col-sm-12">
                                <ul class="list-unstyled mb-4">
                                    @foreach ($commentsTypeProduct as $comment)
                                        @includeIf('comment.partials._table')
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <x-no-data>
                            <x-slot:button>
                                @if (Route::has('admin.statistics.index'))
                                    <a href="{{ route('admin.statistics.index') }}" class="btn btn-primary border lift mt-1">{{ __('Вернутся на главную') }}</a>
                                @endif
                            </x-slot>
                        </x-no-data>
                    @endisset
                </div>
            </div>

        </div>
    </div>

    @isset ($commentsTypePost)
        @if (View::exists('comment.partials._edit'))
            @each('comment.partials._edit', $commentsTypePost, 'comment')
        @endif
    @endisset

    @isset ($commentsTypeProduct)
        @if (View::exists('comment.partials._edit'))
            @each('comment.partials._edit', $commentsTypeProduct, 'comment')
        @endif
    @endisset
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
@endpush
