@extends('layouts.main')

@section('title', trans('Товары'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">

            <x-heading>
                <x-slot:button>
                    @if (Route::has('admin.product.create'))
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-set-task w-sm-100">
                            <i class="icofont-plus-circle me-2 fs-6"></i>
                            {{ __('Добавить товар') }}
                        </a>
                    @endif
                </x-slot:button>
            </x-heading>

            <x-success />

            @isset ($products)
                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <div class="card mb-3 bg-transparent p-2">

                            @if (View::exists('product.partials._table'))
                                @foreach ($products as $product)
                                    @include('product.partials._table')
                                @endforeach
                            @endif

                        </div>

                        @if (View::exists('components.pagination'))
                            {{ $products->links('components.pagination') }}
                        @endif

                    </div>
                </div>
            @else
                <x-no-data>
                    <x-slot:button>
                        @if (Route::has('admin.product.create'))
                            <a href="{{ route('admin.product.create') }}" class="btn btn-primary border lift mt-1">
                                {{ __('Добавьте товар') }}
                            </a>
                        @endif
                    </x-slot>
                </x-no-data>
            @endisset
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
@endpush