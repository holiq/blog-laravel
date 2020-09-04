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
						@if(session('success'))
					        <div class="alert alert-success">
						        {!! session('success') !!}
					        </div>
				        @endif
						<form action="{{ route('permission.store') }}" method="post">
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
						<h4 class="card-title">{{ __('List Permission') }}</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Guard</th>
										<th>Created At</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $no = 1; @endphp
									@forelse($permissions as $key => $row)
									
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $row->name }}</td>
										<td>{{ $row->guard_name }}</td>
										<td>{{ $row->created_at }}</td>
										<td>
											<div class="d-flex">
												<a href="{{ route('permission.show', $row->id) }}" class="btn btn-info btn-sm mx-2"><i class="fa fa-eye"></i></a>
												<a href="{{ route('permission.edit', $row->id) }}" class="btn btn-warning btn-sm mx-2"><i class="fa fa-edit"></i></a>
												<form action="{{ route('permission.destroy', $row->id) }}" method="POST">
													@csrf
													@method('delete')
													<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
												</form>
											</div>
									    </td>
									</tr>
									@empty
									<tr>
										<td colspan="5" class="center">Data doesn't exist</td>
									</tr>
									@endforelse
								</tbody>
							</table>
						</div>
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