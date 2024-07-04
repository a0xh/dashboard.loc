@extends('layouts.admin')

@section('title', 'Заказы')

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
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">

                        <h3 class="fw-bold mb-0">@yield('title')</h3>

                        <div class="col-auto d-flex w-sm-100">
                            <button class="btn btn-primary">
                                <i class="icofont-download-alt me-2 fs-6"></i>
                                {{ __('Экспортировать') }}
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            @if (Session::has('success'))
                <div role="alert" class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div role="alert" class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            @isset ($orders)
                <div class="row clearfix g-3">
                    <div class="col-sm-12">

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="table-responsive">
                                    @include('admin.orders.partials._table')
                                </div>
                            </div>
                        </div>

                        {{ $orders->links('admin.partials._pagination') }}

                    </div>
                </div>
            @else
                @include('admin.partials._no-data')
            @endisset
        </div>
    </div>

    @include('admin.subscribers.partials._create')
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
@endpush