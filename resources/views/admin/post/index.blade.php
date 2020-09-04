@extends('admin.layouts.app')

@section('content')
<section class="section">
	<div class="section-header">
		<div class="section-header-back">
			<a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
		</div>
		<h1 class="m-0 text-dark">Discussions</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Home</a></div>
			<div class="breadcrumb-item">Post</div>
		</div>
	</div>
	<div class="section-body">
		<h2 class="section-title">Post</h2>
		<p class="section-lead">
			On this page you manage post.
		</p>
		<div class="card">
			<div class="card-header">
				<h4>List Post</h4>
				<a href="{{ route('post.create') }}" class="btn btn-primary">Add New</a>
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
								<th>Title</th>
								<th>Thumbnail</th>
								<th>Category</th>
								<th>User</th>
								<th>Created At</th>
								<th>Total Views</th>
								<th>Total Comments</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@php $no = 1; @endphp
							@forelse($post as $row)
							<tr class="text-nowrap">
								<td>{{ $no++ }}</td>
								<td>{{ Str::limit($row->title, 40) }}</td>
								<td><img src="/images/post/{{ $row->thumbnail }}" width="100px"></td>
								<td>{{ $row->category->name }}</td>
								<td>{{ $row->user->name }}</td>
								<td>{{ $row->created_at->format('M-d-Y H:i') }}</td>
								<td>{{ $row->views }}</td>
								<td>{{ $row->countComment->count() }}</td>
								<td>
									<div class="d-flex">
										<a href="{{ route('post.edit', $row->id) }}" class="btn btn-warning btn-sm mx-2"><i class="fa fa-edit"></i></a>
										<form action="{{ route('post.destroy', $row->id) }}" method="POST">
											@csrf
											@method('delete')
											<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
										</form>
									</div>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="4" class="text-center">Post doesn't exits</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				{{ $post->links('vendor.pagination.bootstrap-4') }}
			</div>
		</div>
	</div>	
</section>
@endsection