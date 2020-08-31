@extends('admin.layouts.app')

@section('content')
<section class="section">
	<div class="section-header">
		<div class="section-header-back">
			<a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
		</div>
		<h1 class="m-0 text-dark">Category</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('admin') }}">Home</a></div>
			<div class="breadcrumb-item">Category</div>
		</div>
	</div>
	<div class="section-body">
		<h2 class="section-title">Category</h2>
		<p class="section-lead">
			On this page you can create a new category and fill in all fields.
		</p>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>List Category</h4>
						<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add New</button>
					</div>
					<div class="card-body">
						@if(session('success'))
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
										<th>Total Discussions</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $no = 1; @endphp
									@forelse($category as $row)
									<tr class="text-nowrap">
										<td>{{ $no++ }}</td>
										<td>{{ $row->name }}</td>
										<td>{{ $row->countDiscussion->count() }}</td>
										<td>
											<div class="d-flex">
												@can('edit user')
												<a href="{{ route('category.edit', $row->id) }}" class="btn btn-warning btn-sm mx-2"><i class="fa fa-edit"></i></a>
												@endcan
												<form action="{{ route('category.destroy', $row->id) }}" method="POST">
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
										<td colspan="4" class="text-center">Empty Category</td>
									</tr>
									@endforelse
								</tbody>
							</table>
						</div>
						{{ $category->links('vendor.pagination.bootstrap-4') }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
	<form action="{{ route('category.store') }}" method="post">
		@csrf
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<label for="">Category Name</label>
					<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
					@error('name')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button class="btn btn-primary">
						Save
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection
@error('name')
@push('javascript')
<script>
	$('#exampleModal').modal('show');
</script>
@endpush
@enderror