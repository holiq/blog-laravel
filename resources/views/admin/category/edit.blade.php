@extends('admin.layouts.app')

@section('content')
<section class="section">
	<div class="section-header">
		<div class="section-header-back">
			<a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
		</div>
		<h1 class="m-0 text-dark">Edit Categories</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></div>
			<div class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></div>
			<div class="breadcrumb-item">Edit</div>
		</div>
	</div>
	<div class="section-body">
		<h2 class="section-title">Edit Category</h2>
		<p class="section-lead">
			On this page you can edit a category and fill in all fields.
		</p>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4>Edit</h4>
					</div>
					<div class="card-body">
						@if(session('error'))
							<div class="alert alert-danger">
								{!! session('error') !!}
							</div>
						@endif
						
						<form action="{{ route('category.update', $category->id) }}" method="post">
							@csrf
							@method('put')
							<div class="form-group">
								<label for="">Category Name</label>
								<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $category->name }}" required>
								@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group">
								<button class="btn btn-primary">
									{{ __('Update') }}
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