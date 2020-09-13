@extends('admin.layouts.app')

@section('content')
<section class="section">
	<div class="section-header">
		<div class="section-header-back">
			<a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
		</div>
		<h1 class="m-0 text-dark">Edit User</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></div>
			<div class="breadcrumb-item"><a href="{{ route('role.index') }}">Role</a></div>
			<div class="breadcrumb-item">Edit</div>
		</div>
	</div>
	<div class="section-body">
		<h2 class="section-title">Edit Role</h2>
		<p class="section-lead">
			On this page you can edit role and fill in all fields.
		</p>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4>Edit</h4>
					</div>
					<div class="card-body">
						@if(session('success'))
						<div class="alert alert-success">
							{!! session('success') !!}
						</div>
						@endif
						<form action="{{ route('role.update', $role->id) }}" method="post">
							@csrf
							@method('put')
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" id="name" value="{{ $role->name }}" class="form-control @error('name') is-invalid @enderror" required>
								@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="permission">Permission</label>
								<select class="form-controll selectric" name="permission[]" multiple>
									@foreach($permissions as $key => $row)
									<option value="{{ $row }}" {{ in_array($row, $hasPermission) ? 'selected':'' }}>{{ $row }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<button class="btn btn-primary">
									<i class="fa fa-paper-plane"></i> Update
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