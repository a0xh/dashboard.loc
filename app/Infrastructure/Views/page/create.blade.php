@extends('layouts.main')

@section('title', 'Добавление страницы')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">

            <x-heading />
            <x-errors />
            <x-message />

            <form action="{{ route('admin.page.store') }}" method="post" enctype="multipart/form-data">
                
                @csrf
                @includeIf('page.partials._form')

            </form>
            
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            ClassicEditor.create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '{{ route('admin.media.upload') . '?_token=' . csrf_token() }}',
                }
            });
        });

        $(function() {
            $('.dropify').dropify();
        });
    </script>
@endpush