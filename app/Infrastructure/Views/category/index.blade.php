@extends('layouts.main')

@section('title', trans('Категории'))

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
                            <a href="#post" class="nav-link active" data-bs-toggle="tab" role="tab">{{ __('Категории постов') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="#product" class="nav-link" data-bs-toggle="tab" role="tab">{{ __('Категории товаров') }}</a>
                        </li>
                    </ul>
                </x-slot:button>
            </x-heading>

            <x-success />

            <div class="tab-content">
                <div id="post" class="tab-pane fade show active">
                    @if (count($categoriesTypePost) !== 0)
                        <div class="row clearfix g-3">
                            <div class="col-sm-12">

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            @include('category.partials._table', [
                                                'categories' => $categoriesTypePost
                                            ])
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 align-items-center">
                                    <div class="col-md-6">
                                        @if (Route::has('admin.category.create'))
                                            <a href="{{ route('admin.category.create', ['type' => 'post']) }}" class="btn btn-primary btn-set-task w-sm-100">
                                                <i class="icofont-plus-circle me-2 fs-6"></i>
                                                {{ __('Добавить категорию') }}
                                            </a>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        {{ $categoriesTypePost->links('components.pagination') }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <div class="card mb-3">
                                <x-no-data>
                                    <x-slot:button>
                                        @if (Route::has('admin.category.create'))
                                            <a href="{{ route('admin.category.create', ['type' => 'post']) }}" class="btn btn-primary border lift mt-1">{{ __('Добавить категорию') }}</a>
                                        @endif
                                    </x-slot>
                                </x-no-data>
                            </div>
                        </div>
                    @endif
                </div>

                <div id="product" class="tab-pane fade">
                    @if (count($categoriesTypeProduct) !== 0)
                        <div class="row clearfix g-3">
                            <div class="col-sm-12">
                                
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            @include('category.partials._table', [
                                                'categories' => $categoriesTypeProduct
                                            ])
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 align-items-center">
                                    <div class="col-md-6">
                                        @if (Route::has('admin.category.create'))
                                            <a href="{{ route('admin.category.create', ['type' => 'product']) }}" class="btn btn-primary btn-set-task w-sm-100">
                                                <i class="icofont-plus-circle me-2 fs-6"></i>
                                                {{ __('Добавить категорию') }}
                                            </a>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        {{ $categoriesTypeProduct->links('components.pagination') }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <div class="card mb-3">
                                <x-no-data>
                                    <x-slot:button>
                                        @if (Route::has('admin.category.create'))
                                            <a href="{{ route('admin.category.create', ['type' => 'product']) }}" class="btn btn-primary border lift mt-1">{{ __('Добавить категорию') }}</a>
                                        @endif
                                    </x-slot>
                                </x-no-data>
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