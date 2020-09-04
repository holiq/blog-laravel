@extends('admin.layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class="m-0 text-dark">Add New Post</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></div>
            <div class="breadcrumb-item"><a href="{{ route('post.index') }}">Post</a></div>
            <div class="breadcrumb-item">Add New</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Create New Post</h2>
        <p class="section-lead">
            On this page you can create a new post and fill in all fields.
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
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="">{{ __('Title') }}</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" required="required" name="title" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ __('Tags') }}</label>
                                <input type="text" class="form-control @error('tags') is-invalid @enderror" required="required" name="tags" value="{{ old('tags') }}">
                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">{{ __('Content') }}</label>
                                <textarea id="summernote" class="form-control @error('content') is-invalid @enderror" value="{{ old('content') }}" required="required" name="content"></textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('Thumbnail') }}</label>
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="thumbnail" id="image-upload" />
                                </div>
                                @error('thumbnail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Create Post">
                     </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@push('stylesheet')
<link rel="stylesheet" href="{{ asset('package/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('package/summernote/summernote-bs4.min.css') }}">
@endpush
@push('javascript')
<script src="https://opoloo.github.io/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js"></script>
<script src="{{ asset('package/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('package/summernote/summernote-bs4.min.js') }}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    $('#summernote').summernote({
        height:'250px',
        callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
                console.log(image[0]);
            },
            onMediaDelete: function(target) {
                deleteImage(target[0].src);
            },
        },
    });
    $.uploadPreview({
        input_field: "#image-upload",   // Default: .image-upload
        preview_box: "#image-preview",  // Default: .image-preview
        label_field: "#image-label",    // Default: .image-label
        label_default: "Choose Image",  // Default: Choose File
        label_selected: "Change Image", // Default: Change File
        no_label: false,                // Default: false
        success_callback: null          // Default: null
    });
});
function uploadImage(image) {
    var data = new FormData();
    data.append("file", image);
    $.ajax({
        url: "{{ route('summernote.store') }}",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "post",
        success: function(url) {
            var image = $('<img>').attr('src', url).addClass('img-content');
            $('#summernote').summernote("insertNode", image[0]);
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
         url: "{{ route('summernote.delete') }}",
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