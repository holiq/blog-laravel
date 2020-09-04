<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Laravel') }}</title>
	<link rel="stylesheet" href="{{ asset('package/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('package/font-awesome/css/all.min.css') }}">
	@stack('stylesheet')
	<link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">
	<link rel="stylesheet" href="{{ asset('stisla/css/custom.css') }}">
</head>

<body>
<div id="app">
	@yield('app')
</div>

	<!-- Template JS File -->
	<script src="{{ asset('package/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('package/popper/popper.min.js') }}"></script>
	<script src="{{ asset('package/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
	<script src="{{ asset('stisla/js/stisla.js') }}"></script>
	<script src="{{ asset('stisla/js/scripts.js') }}"></script>
	<script src="{{ asset('stisla/js/custom.js') }}"></script>
	<script src="{{ asset('package/eruda/eruda.min.js') }}"></script>
	<script>eruda.init();</script>
	@stack('javascript')
</body>
</html>
