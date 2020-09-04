@extends('admin.layouts.app')

@section('content')
<section class="section">
	<div class="section-header">
		<div class="section-header-back">
			<a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
		</div>
		<h1 class="m-0 text-dark">Management Role</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Home</a></div>
			<div class="breadcrumb-item">Role</div>
		</div>
	</div>
	<div class="section-body">
		<h2 class="section-title">Create New Role</h2>
		<p class="section-lead">
			On this page you can create a new role and fill in all fields.
		</p>
		<div class="row">
			<div class="col-md-4">
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
						
						<form role="form" action="{{ route('role.store') }}" method="POST" class="needs-validation" novalidate="">
							@csrf
							<div class="form-group">
								<label for="name">Role</label>
								<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" required>
								@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="permission">Permission</label>
								<select class="form-controll selectric" name="permission[]" multiple>
									@foreach($permissions as $row)
									<option value="{{ $row->name }}">{{ $row->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
							    <button class="btn btn-primary">Add New</button>
						    </div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<h4>List Role</h4>
					</div>
					<div class="card-body">
						@if(session('success'))
						<div class="alert alert-success">
							{!! session('success') !!}
						</div>
						@endif
						<div class="table-responsive">
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Role</th>
										<th>Permission</th>
										<th>Created At</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@php $no = 1; @endphp
								@forelse($roles as $row)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $row->name }}</td>
										<td>
											@foreach($row->permissions as $permission)
											    <div class="badge badge-primary badge-sm">{{ $permission->name }}</div>
											@endforeach
										</td>
										<td>{{ $row->created_at }}</td>
										<td>
											<div class="d-flex">
												<a href="{{ route('role.show', $row->id) }}" class="btn btn-info btn-sm mx-2"><i class="fa fa-eye"></i></a>
												<a href="{{ route('role.edit', $row->id) }}" class="btn btn-warning btn-sm mx-2"><i class="fa fa-edit"></i></a>
												<form action="{{ route('role.destroy', $row->id) }}" method="POST">
													@csrf
													@method('delete')
													<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
												</form>
											</div>
									    </td>
										</td>
									</tr>
									@empty
									<tr>
										<td colspan="5" class="text-center">Tidak ada data</td>
									</tr>
								@endforelse
								</tbody>
							</table>
						</div>
						{{ $roles->links('vendor.pagination.bootstrap-4') }}
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