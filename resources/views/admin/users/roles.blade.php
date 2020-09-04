@extends('admin.layouts.app')

@section('content')
<section class="section">
	<div class="section-header">
		<div class="section-header-back">
			<a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
		</div>
		<h1 class="m-0 text-dark">Role Permission</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></div>
			<div class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></div>
			<div class="breadcrumb-item">Set Role</div>
		</div>
	</div>
	<div class="section-body">
		<h2 class="section-title">{{ __('Set Role') }}</h2>
		<p class="section-lead">
			{{ __('On this page you can create a new post and fill in all fields.') }}
		</p>
		
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h4>Set Permission to Role</h4>
					</div>
					<div class="card-body">
						@if(session('success'))
							<div class="alert alert-success">
								{!! session('success') !!}
							</div>
						@endif
						<form action="{{ route('users.set_role', $user->id) }}" method="post">
							@csrf
							@method('put')
							<div class="table-responsive">
								<table class="table table-hover table-bordered">
									<thead>
										<tr>
											<th>Nama</th>
											<td>:</td>
											<td>{{ $user->name }}</td>
										</tr>
										<tr>
											<th>Email</th>
											<td>:</td>
											<td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
										</tr>
										<tr>
											<th>Role</th>
											<td>:</td>
											<td>
												@foreach ($roles as $row)
												<div class="custom-control custom-radio">
													<input type="radio" id="{{ $row }}" name="role" class="custom-control-input" value="{{ $row }}" {{ $user->hasRole($row) ? 'checked':'' }}>
													<label class="custom-control-label" for="{{ $row }}">{{ $row }}</label>
												</div>
												@endforeach
											</td>
										</tr>
									</thead>
								</table>
							</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-primary float-right">
									Set Role
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