@extends('layouts.main')

@section('title', trans('messages.admin.page.index'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">

            <x-heading>
                <x-slot:button>
                    @if (Route::has('admin.page.create'))
                        <a href="{{ route('admin.page.create') }}" class="btn btn-primary btn-set-task w-sm-100">
                            <i class="icofont-plus-circle me-2 fs-6"></i>
                            {{ __('Добавить страницу') }}
                        </a>
                    @endif
                </x-slot:button>
            </x-heading>

            <x-success />

            @isset ($pages)
                <div class="row clearfix g-3">
                    <div class="col-sm-12">
                        
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="table-responsive">

                                    @if (View::exists('page.partials._table'))
                                        @include('page.partials._table')
                                    @endif

                                </div>
                            </div>
                        </div>

                        @if (View::exists('components.pagination'))
                            {{ $pages->links('components.pagination') }}
                        @endif

                    </div>
                </div>
            @else
                <x-no-data>
                    <x-slot:button>
                        @if (Route::has('admin.page.create'))
                            <a href="{{ route('admin.page.create') }}" class="btn btn-primary border lift mt-1">{{ __('Добавить страницу') }}</a>
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