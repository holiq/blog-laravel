@extends('admin.layouts.app')

@section('content')
<section class="section">
	<div class="section-header">
		<div class="section-header-back">
			<a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
		</div>
		<h1 class="m-0 text-dark">Comment</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('admin') }}">Home</a></div>
			<div class="breadcrumb-item">Comment</div>
		</div>
	</div>
	<div class="section-body">
		<h2 class="section-title">Comment</h2>
		<p class="section-lead">
			On this page you can manage comment.
		</p>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						{{ $countComment }}
					</div>
					<div class="col-md-4">
						{{ $countReply }}
					</div>
					<div class="col-md-4">
						{{ $countComment }}
					</div>
				</div>
			</div>
		</div>
		<h4 class="mt-3 mb-2">List</h4>
		@foreach($comment as $row)
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<a href="#">
							{{ $row->getTitle->pluck('title')->implode(' ') }}
						</a>
					</div>
					<div class="col-md-8">
						{!! Str::limit($row->comment, '300') !!}
					</div>
				</div>
			</div>
		</div>
		
		@foreach($row->replies as $rows)
		@if($rows->parent_id == "")
			@php $m = 0 @endphp
		@else
			@php $m = 20 @endphp
		@endif
		<div class="card">
			<div class="card-body">
				<a href="#" data-toggle="collapse" data-target="#comment-{{ $row->id }}" aria-expanded="false" aria-controls="comment-{{ $rows->id }}">Show Replies</a>
				<div class="collapse multi-collapse" id="comment-{{ $row->id }}">
					<div class="mt-4 reply" style="margin-left: {{ $m }}px">
					{!! Str::limit($rows->comment, '300') !!}
					@include('admin.comment.reply', ['comment' => $rows->replies, 'm' => $m,])
					</div>
				</div>
			</div>
		</div>
		@endforeach
		@endforeach
	</div>	
</section>
@endsection