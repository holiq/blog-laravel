@extends('admin.layouts.app')

@section('content')
<section class="section">
	<div class="section-header">
		<div class="section-header-back">
			<a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
		</div>
		<h1 class="m-0 text-dark">Add New Discussion</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></div>
			<div class="breadcrumb-item"><a href="{{ route('discussion.index') }}">Discussions</a></div>
			<div class="breadcrumb-item">Add New</div>
		</div>
	</div>
	<div class="section-body">
		<h2 class="section-title">Create New Discussion</h2>
		<p class="section-lead">
			On this page you can create a new discussion and fill in all fields.
		</p>
		
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
				<form action="{{ route('discussion.store') }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('post')
					<div class="form-group">
						<label for="">{{ __('Title') }}</label>
						<input type="text" class="form-control @error('judul') is-invalid @enderror" required="required" name="judul" value="{{ old('judul') }}">
						@error('judul')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group">
						<label for="">{{ __('Category') }}</label>
						<select name="category_id" class="form-control selectric @error('category_id') is-invalid @enderror" value="{{ old('category_id') }}" required="required">
							@foreach($category as $c)
								<option value="{{ $c->id }}">{{ $c->name }}</option>
							@endforeach
						</select>
						@error('category_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group">
						<label for="">{{ __('Content') }}</label>
						<textarea id="editor_forum" class="form-control @error('content') is-invalid @enderror" value="{{ old('content') }}" required="required" name="content"></textarea>
						@error('content')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Create Discussion">
					 </div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('stylesheet')
<link rel="stylesheet" href="{{ asset('package/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('package/summernote/dist/summernote.css') }}">
@endpush
@push('javascript')
<script src="{{ asset('package/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('package/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('package/emoji/emoji.js') }}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
  url: 'https://api.github.com/emojis',
  async: false 
}).then(function(data) {
  window.emojis = Object.keys(data);
  window.emojiUrls = data; 
});

$(document).ready(function(){
  $('#editor_forum').summernote({
    height:'250px',
    callbacks: {
      onImageUpload: function(image) {
        uploadImage(image[0]);
        console.log(image[0]);
      },
      onMediaDelete: function(target) {
        deleteImage(target[0].src);
      }
    },
    hint: {
      match: /:([\-+\w]+)$/,
      search: function (keyword, callback) {
        callback($.grep(emojis, function (item) {
          return item.indexOf(keyword)  === 0;
        }));
      },
      template: function (item) {
        var content = emojiUrls[item];
        return '<img src="' + content + '" width="20" /> :' + item + ':';
      },
      content: function (item) {
        var url = emojiUrls[item];
        if (url) {
          return $('<img />').attr('src', url).addClass('emoji-img-inline')[0];
        }
        return '';
      }
    }
  });
});
function uploadImage(image) {
  var data = new FormData();
  data.append("file", image);
  $.ajax({
    url: "{{ route('upload.image') }}",
    cache: false,
    contentType: false,
    processData: false,
    data: data,
    type: "post",
    success: function(url) {
      var image = $('<img>').attr('src', url).addClass('imdis');
      $('#editor_forum').summernote("insertNode", image[0]);
      console.log(url);
    },
    error: function(data) {
      console.log(data);
    }
  });
}

function deleteImage(src) {
  $.ajax({
    data: {src : src},
    type: "POST",
    url: "{{ route('delete.image') }}",
    cache: false,
    success: function(response) {
      console.log(response);
    }
  });
}
$(document).ready(function(){
  $('.note-modal').appendTo("body");
});
</script>
@endpush