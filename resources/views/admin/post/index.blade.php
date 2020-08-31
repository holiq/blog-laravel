@extends('admin.layouts.app')

@section('content')
<section class="section">
	<div class="section-header">
		<div class="section-header-back">
			<a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
		</div>
		<h1 class="m-0 text-dark">Discussions</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('admin') }}">Home</a></div>
			<div class="breadcrumb-item">Discussion</div>
		</div>
	</div>
	<div class="section-body">
		<h2 class="section-title">Discussion</h2>
		<p class="section-lead">
			On this page you can create a new discussion and fill in all fields.
		</p>
		<div class="card">
			<div class="card-header">
				<h4>List Discussion</h4>
				<a href="{{ route('discussion.create') }}" class="btn btn-primary">Add New</a>
			</div>
			<div class="card-body">
				@if(session('success.down'))
					<div class="alert alert-success">
						{!! session('success.down') !!}
					</div>
				@endif
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Category</th>
								<th>User</th>
								<th>Created At</th>
								<th>Total Views</th>
								<th>Total Comments</th>
								@role('admin')
								<th>Action</th>
								@endrole
							</tr>
						</thead>
							<tbody>
								@php $no = 1; @endphp
								@forelse($discussion as $row)
								<tr class="text-nowrap">
									<td>{{ $no++ }}</td>
									<td>{{ Str::limit($row->title, 40) }}</td>
									<td>{{ $row->category->name }}</td>
									<td>{{ $row->user->name }}</td>
									<td>{{ $row->created_at->format('F d, Y H:i') }}</td>
									<td>{{ $row->content_read }}</td>
									<td>{{ $row->countComment->count() }}</td>
									<td>
										<div class="d-flex">
											@role('admin')
											<a href="{{ route('discussion.edit', $row->id) }}" class="btn btn-warning btn-sm mx-2"><i class="fa fa-edit"></i></a>
											<form action="{{ route('discussion.destroy', $row->id) }}" method="POST">
												@csrf
												@method('delete')
												@can('delete user')
												<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
												@endcan
											</form>
											@endrole
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
					{{ $discussion->links('vendor.pagination.bootstrap-4') }}
				</div>
			</div>
		</div>
	</div>	
</section>
@endsection