@extends('admin.layouts.app')

@section('content')
<section class="section">
	<div class="section-header">
		<div class="section-header-back">
			<a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
		</div>
		<h1 class="m-0 text-dark">List Users</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></div>
			<div class="breadcrumb-item">User</div>
		</div>
	</div>
	<div class="section-body">
		<h2 class="section-title">Create New Post</h2>
		<p class="section-lead">
			On this page you can create a new post and fill in all fields.
		</p>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					@can('create user')
					<div class="card-header">
						<a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">Add New</a>
					</div>
					@endcan
					<div class="card-body">
						@if (session('success'))
						<div class="alert alert-success">
							{!! session('success') !!}
						</div>
						@endif
						
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Email</th>
										<th>Created At</th>
										<th>Role</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $no = 1; @endphp
									@forelse($users as $row)
									<tr class="text-nowrap">
										<td>{{ $no++ }}</td>
										<td>{{ $row->name }}</td>
										<td>{{ $row->email }}</td>
										<td>{{ $row->created_at->format('F d, Y H:i') }}</td>
										<td>
											@if($row->roles()->pluck('name')->implode(' ') == "user")
											<label for="" class="badge badge-info">{{  $row->roles()->pluck('name')->implode(' ') }}</label>
											@else
											<label for="" class="badge badge-primary">{{  $row->roles()->pluck('name')->implode(' ') }}</label>
											@endif
										</td>
										<td>
											@if ($row->status)
											<label class="badge badge-success">Active</label>
											@else
											<label for="" class="badge badge-warning">Suspend</label>
											@endif
										</td>
										<td>
											<div class="d-flex">
												@can('set permission user')
												<a href="{{ route('users.roles', $row->id) }}" class="btn btn-info btn-sm"><i class="fa fa-user-secret"></i></a>
												@endcan
												@can('edit user')
												<a href="{{ route('users.edit', $row->id) }}" class="btn btn-warning btn-sm mx-2"><i class="fa fa-edit"></i></a>
												@endcan
												<form action="{{ route('users.destroy', $row->id) }}" method="POST">
													@csrf
													@method('delete')
													@can('delete user')
													<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
													@endcan
												</form>
											</div>
										</td>
									</tr>
									@empty
									<tr>
										<td colspan="4" class="text-center">Tidak ada data</td>
									</tr>
									@endforelse
								</tbody>
							</table>
						</div>
						{{ $users->links('vendor.pagination.bootstrap-4') }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection