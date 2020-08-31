@extends('admin.layouts.app')

@section('content')
<section class="section">
	<div class="section-header">
		<div class="section-header-back">
			<a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
		</div>
		<h1 class="m-0 text-dark">Role Permission</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></div>
			<div class="breadcrumb-item">Role Permission</div>
		</div>
	</div>
	<div class="section-body">
		<h2 class="section-title">{{ __('Create Role Permission') }}</h2>
		<p class="section-lead">
			{{ __('On this page you can create a new post and fill in all fields.') }}
		</p>
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">{{ __('Add New Permission') }}</h4>
					</div>
					<div class="card-body">
						<form action="{{ route('users.add_permission') }}" method="post" class="needs-validation" novalidate="">
							@csrf
							<div class="form-group">
								<label for="name">{{ __('Name') }}</label>
								<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
								@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group">
								<button class="btn btn-primary btn-sm">
									Add New
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Set Permission to Role</h4>
					</div>
					<div class="card-body">
						@if(session('success'))
							<div class="alert alert-success">
								{!! session('success') !!}
							</div>
						@endif
						
						<form action="{{ route('users.roles_permission') }}" method="GET">
							<div class="form-group">
								<label for="role">Roles</label>
								<select id="role" name="role" class="form-control selectric">
									@foreach ($roles as $value)
										<option value="{{ $value }}" {{ request()->get('role') == $value ? 'selected':'' }}>{{ $value }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<button class="btn btn-danger btn-sm">Check</button>
							</div>
						</form>
						@if(!empty($permissions))
						<form action="{{ route('users.setRolePermission', request()->get('role')) }}" method="post">
							@csrf
							@method('put')
							<div class="form-group">
								<h6>Permissions</h6>
								<hr>
								<div class="row">
									@foreach($permissions as $key => $row)
									<div class="col-6 col-md-4">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="permission[]" id="{{ $row }}" class="custom-control-input" value="{{ $row }}" {{ in_array($row, $hasPermission) ? 'checked':'' }}>
											<label class="custom-control-label" for="{{ $row }}">{{ $row }}</label>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							
							<div class="pull-right">
								<button class="btn btn-primary">
									<i class="fa fa-send"></i> {{ __('Set Permission') }}
								</button>
							</div>
						</form>
						@endif
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