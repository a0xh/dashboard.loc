@extends('layouts.main')

@section('title', trans('messages.admin.order.index'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">

            <x-heading>
                <x-slot:button>
                    <button class="btn btn-primary">
                        <i class="icofont-download-alt me-2 fs-6"></i>
                        {{ __('Экспортировать') }}
                    </button>
                </x-slot:button>
            </x-heading>

            <x-success />
            <x-errors />
            <x-message />

            @isset ($orders)
                <div class="row clearfix g-3">
                    <div class="col-sm-12">

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="table-responsive">

                                    @if (View::exists('order.partials._table'))
                                        @include('order.partials._table')
                                    @endif

                                </div>
                            </div>
                        </div>

                        @if (View::exists('components.pagination'))
                            {{ $orders->links('components.pagination') }}
                        @endif

                    </div>
                </div>
            @else
                <x-no-data />
            @endisset
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
@endpush