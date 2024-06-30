@extends('layouts.main')

@section('title', trans('Посты'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">

            <x-heading>
                <x-slot:button>
                    @if (Route::has('admin.post.create'))
                        <a href="{{ route('admin.post.create') }}" class="btn btn-primary btn-set-task w-sm-100">
                            <i class="icofont-plus-circle me-2 fs-6"></i>
                            {{ __('Добавить пост') }}
                        </a>
                    @endif
                </x-slot:button>
            </x-heading>

            <x-success />

            @isset ($posts)
                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <div class="card mb-3 bg-transparent p-2">

                            @foreach ($posts as $post)
                                @if (View::exists('post.partials._table'))
                                    @include('post.partials._table')
                                @endif
                            @endforeach

                        </div>

                        {{ $posts->links('components.pagination') }}

                    </div>
                </div>
            @else
                <x-no-data>
                    <x-slot:button>
                        @if (Route::has('admin.post.create'))
                            <a href="{{ route('admin.post.create') }}" class="btn btn-primary border lift mt-1">
                                {{ __('Добавьте пользователя') }}
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