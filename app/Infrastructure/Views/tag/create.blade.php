@extends('layouts.admin')

@section('title', 'Добавление тега')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dropify.min.css') }}">
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
                    </div>
                </div>
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div role="alert" class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            <form method="post" action="{{ route('admin.tags.store') }}" enctype="multipart/form-data">

                @csrf
                @include('admin.tags.partials._form')

            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>

    <script>
        $(function() {
            $('.dropify').dropify();

            var drEvent = $('#dropify-event').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });
        });
    </script>
@endpush
