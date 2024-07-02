@extends('layouts.main')

@section('title', trans('messages.admin.statistics.index'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">

            <x-heading />

        	<div class="col-12">
            	<x-no-data>
            		<x-slot:button>
            			@if (Route::has('admin.statistics.index'))
            				<a href="{{ route('admin.statistics.index') }}" class="btn btn-primary border lift mt-1">{{ __('Выйти из панельки ➥') }}</a>
            			@endif
            		</x-slot>
            	</x-no-data>
        	</div>
            
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
@endpush
