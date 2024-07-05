@extends('layouts.main')

@section('title', trans('messages.admin.subscriber.index'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">

            <x-heading>
                <x-slot:button>
                    @if (View::exists('subscriber.partials._create'))
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-subscriber">
                            <i class="icofont-plus-circle me-2 fs-6"></i>
                            {{ __('Добавить подписчика') }}
                        </button>
                    @endif
                </x-slot:button>
            </x-heading>

            <x-success />
            <x-errors />
            <x-message />

            @isset ($subscribers)
                <div class="row clearfix g-3">
                    <div class="col-sm-12">

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="table-responsive">

                                    @if (View::exists('subscriber.partials._table'))
                                        @include('subscriber.partials._table')
                                    @endif

                                </div>
                            </div>
                        </div>

                        @if (View::exists('components.pagination'))
                            {{ $subscribers->links('components.pagination') }}
                        @endif

                    </div>
                </div>
            @else
                <x-no-data>
                    <x-slot:button>
                        @if (View::exists('subscriber.partials._create'))
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-subscriber">
                                <i class="icofont-plus-circle me-2 fs-6"></i>
                                {{ __('Добавить подписчика') }}
                            </button>
                        @endif
                    </x-slot>
                </x-no-data>
            @endisset
        </div>
    </div>

    @includeIf('subscriber.partials._create')
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
@endpush