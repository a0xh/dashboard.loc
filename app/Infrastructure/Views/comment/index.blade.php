@extends('layouts.admin')

@section('title', 'Комментарии')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('header')
    @include('admin.partials._header')
@endsection

@section('content')
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">

                        <h3 class="fw-bold mb-0 py-3 pb-2">@yield('title')</h3>

                        <div class="col-auto py-2 w-sm-100">
                            <ul class="nav nav-tabs tab-body-header rounded invoice-set" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#post" role="tab">{{ __('Комментарии постов') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#product" role="tab">{{ __('Комментарии товаров') }}</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            @if(Session::has('success'))
                <div role="alert" class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div role="alert" class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            <div class="tab-content">
                <div id="post" class="tab-pane fade show active">
                    @isset ($commentsTypePost)
                        <div class="row clearfix g-3">
                            <div class="col-sm-12">
                                <ul class="list-unstyled mb-4">
                                    @foreach ($commentsTypePost as $comment)
                                        @if ($comment->type !== 'product')
                                            @include('admin.comments.partials._table')
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-body text-center p-5">
                                    @if (File::exists('assets/img/no-data.svg'))
                                        <img src="{{ asset('assets/img/no-data.svg') }}" class="img-fluid mx-size">
                                    @endif

                                    <div class="mt-4 mb-2">
                                        <span class="text-muted">{{ __('Комментарии постов пока отсутствуют!') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endisset
                </div>

                <div id="product" class="tab-pane fade">
                    @isset ($commentsTypeProduct)
                        <div class="row clearfix g-3">
                            <div class="col-sm-12">
                                <ul class="list-unstyled mb-4">
                                    @foreach ($commentsTypeProduct as $comment)
                                        @if ($comment->type !== 'post')
                                            @include('admin.comments.partials._table')
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-body text-center p-5">
                                    @if (File::exists('assets/img/no-data.svg'))
                                        <img src="{{ asset('assets/img/no-data.svg') }}" class="img-fluid mx-size">
                                    @endif

                                    <div class="mt-4 mb-2">
                                        <span class="text-muted">{{ __('Комментарии товаров пока отсутствуют!') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>

        </div>
    </div>

    @isset ($commentsTypePost)
        @each('admin.comments.partials._edit', $commentsTypePost, 'comment')
    @endisset

    @isset ($commentsTypeProduct)
        @each('admin.comments.partials._edit', $commentsTypeProduct, 'comment')
    @endisset
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
@endpush
