<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}" dir="ltr">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    {{-- CSRF Token --}}
	    <meta name="csrf-token" content="{{ csrf_token() }}">

	    <title>@yield('title') | {{ trans('PHPlander') }}</title>

	    {{-- Favicons --}}
	    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32" />
	    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon.png') }}" />
	    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" sizes="192x192" />
	    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicon.png') }}" />

	    {{-- CSS Files --}}
	    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	</head>
	
	<body>

		{{-- Content --}}
	    <div id="ebazar-layout" class="theme-blue">
	        <div class="main p-2 py-3 p-xl-5 ">
	            @yield('content')
	        </div>
	    </div>

	    {{-- JS Files --}}
	    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>
	</body>
</html>
