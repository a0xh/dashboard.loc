@extends('layouts.main')

@section('title', trans('Пользователи'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">

            <x-heading>
            	<x-slot:button>
            		@if (Route::has('admin.user.create'))
	                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-set-task w-sm-100">
	                        <i class="icofont-plus-circle me-2 fs-6"></i>
	                        {{ __('Добавить пользователя') }}
	                    </a>
		            @endif
            	</x-slot>
        	</x-heading>

            <x-success />

            @isset ($users)
                <div class="row clearfix g-3">
                    <div class="col-sm-12">

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="table-responsive">

									@if (View::exists('user.partials._table'))
										@include('user.partials._table')
									@endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @else
                <x-no-data>
                    <x-slot:button>
                    	@if (Route::has('admin.user.create'))
		                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary border lift mt-1">
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
