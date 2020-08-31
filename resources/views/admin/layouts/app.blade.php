@extends('admin.layouts.skeleton')

@section('app')
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		@auth
		<nav class="navbar navbar-expand-lg main-navbar">
			@include('admin.partials.navbar')
		</nav>
		<div class="main-sidebar">
			@include('admin.partials.sidebar')
		</div>
		@endauth
		<!-- Main Content -->
		<div class="main-content">
			@yield('content')
		</div>
		<footer class="main-footer">
			@include('admin.partials.footer')
		</footer>
	</div>
@endsection
