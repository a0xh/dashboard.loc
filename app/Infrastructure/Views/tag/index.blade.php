@extends('layouts.admin')

@section('title', 'Теги')

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
                                    <a class="nav-link active" data-bs-toggle="tab" href="#post" role="tab">{{ __('Теги постов') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#product" role="tab">{{ __('Теги товаров') }}</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div id="post" class="tab-pane fade show active">
                    @if (count($tagsTypePost) !== 0)
                        <div class="row clearfix g-3">
                            <div class="col-sm-12">

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            @include('admin.tags.partials._table', [
                                                'tags' => $tagsTypePost
                                            ])
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 align-items-center">
                                    <div class="col-md-6">
                                        @if (Route::has('admin.tags.create'))
                                            <a href="{{ route('admin.tags.create', ['type' => 'post']) }}" class="btn btn-primary btn-set-task w-sm-100">
                                                <i class="icofont-plus-circle me-2 fs-6"></i>
                                                {{ __('Добавить тег') }}
                                            </a>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        {{ $tagsTypePost->links('admin.partials._pagination') }}
                                    </div>
                                </div>

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
                                        <span class="text-muted">{{ __('Нет данных для отображения!') }}</span>
                                    </div>

                                    @if (Route::has('admin.tags.create'))
                                        <a href="{{ route('admin.tags.createTypePost', ['type' => 'post']) }}" class="btn btn-primary border lift mt-1">{{ __('Добавить тег') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div id="product" class="tab-pane fade">
                    @if (count($tagsTypeProduct) !== 0)
                        <div class="row clearfix g-3">
                            <div class="col-sm-12">
                                
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            @include('admin.tags.partials._table', [
                                                'tags' => $tagsTypeProduct
                                            ])
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 align-items-center">
                                    <div class="col-md-6">
                                        @if (Route::has('admin.tags.create'))
                                            <a href="{{ route('admin.tags.create', ['type' => 'product']) }}" class="btn btn-primary btn-set-task w-sm-100">
                                                <i class="icofont-plus-circle me-2 fs-6"></i>
                                                {{ __('Добавить тег') }}
                                            </a>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        {{ $tagsTypeProduct->links('admin.partials._pagination') }}
                                    </div>
                                </div>

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
                                        <span class="text-muted">{{ __('Нет данных для отображения!') }}</span>
                                    </div>

                                    @if (Route::has('admin.tags.create'))
                                        <a href="{{ route('admin.tags.create', ['type' => 'product']) }}" class="btn btn-primary border lift mt-1">{{ __('Добавить тег') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
@endpush
