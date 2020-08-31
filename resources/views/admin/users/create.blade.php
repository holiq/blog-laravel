@extends('admin.layouts.app')

@section('content')
<section class="section">
	<div class="section-header">
		<div class="section-header-back">
			<a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
		</div>
		<h1 class="m-0 text-dark">Add New Users</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></div>
			<div class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></div>
			<div class="breadcrumb-item">Add New</div>
		</div>
	</div>
	<div class="section-body">
		<h2 class="section-title">Create New User</h2>
		<p class="section-lead">
			On this page you can create a new user and fill in all fields.
		</p>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4>Add New</h4>
					</div>
					<div class="card-body">
						@if(session('error'))
							<div class="alert alert-danger">
								{!! session('error') !!}
							</div>
						@endif
						
						<form action="{{ route('users.store') }}" method="post" class="needs-validation" novalidate="">
							@csrf
							<div class="form-group">
								<label for="">Nama</label>
								<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
								@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="">Email</label>
								<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="">Password</label>
								<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="">Role</label>
								<select name="role" class="form-control selectric @error('role') is-invalid @enderror" required>
									<option value="">Select</option>
									@foreach ($role as $row)
									<option value="{{ $row->name }}">{{ $row->name }}</option>
									@endforeach
								</select>
								@error('role')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group">
								<button class="btn btn-primary">
									<i class="fa fa-paper-plane"></i> Save
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@push('stylesheet')
<link rel="stylesheet" href="{{ asset('package/selectric/public/selectric.css') }}">
@endpush
@push('javascript')
<script src="{{ asset('package/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush