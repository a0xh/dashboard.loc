@extends('layouts.main')

@section('title', trans('Редактирование пользователя'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dropify.min.css') }}" ansyc>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
	<div class="body d-flex py-lg-3 py-md-2">
	    <div class="container-xxl">

	    	<x-heading />
	        <x-errors />
            <x-message />
            
	        @if (Route::has('admin.user.update'))
		        @fragment('user-edit')
			        <form action="{{ route('admin.user.update', $user)}}" method="post" enctype="multipart/form-data">

			            @method('PUT')
			            @csrf

			            @includeIf('user.partials._form')

			        </form>
		        @endfragment
            @else
                <x-no-data>
                    <x-slot:button>
                        @if (Route::has('admin.statistics.index'))
		    				<a href="{{ route('admin.statistics.index') }}" class="btn btn-primary border lift mt-1">{{ __('Вернутся на главную') }}</a>
		    			@endif
                    </x-slot>
                </x-no-data>
		    @endif

	    </div>
	</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.bundle.js') }}" ansyc></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>

    <script>
        $(function() {
            $('.dropify').dropify();
        });
    </script>
@endpush