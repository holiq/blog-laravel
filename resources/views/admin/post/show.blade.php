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
            <div class="breadcrumb-item"><a href="{{ route('posts.index') }}">Post</a></div>
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
                <img class="w-100" src="/images/post/{{ $post->thumbnail }}" alt="">
                <div class="p-4 h-auto">
                    <a class="d-inline-block bg-indigo-700 py-1 px-2 rounded mb-2 text-light text-xs uppercase" href="#">{{ $post->category->name }}</a>
                    <h5 class="block text-gray-900 font-semibold mb-2 text-xl md:text-base lg:text-lg">
                        {{ $post->title }}
                    </h5>
                    <div class="d-flex text-gray-700 text-sm my-2">
                        <i class="fa fa-calendar mr-1"></i><div>Posted by <span class="font-semibold">{{ $post->user->name}} </span></div>
                        <span class="px-2">{{ $post->created_at->format('M d, Y') }}</span>
                        <span class="text-danger">{{ $post->featured ? 'Featured':'' }}</span>
                    </div>
                    <div class="text-gray-700 leading-relaxed">
                        {!! $post->content !!}
                    </div>
                    <div class="d-flex justify-content-left flex-wrap mt-2 mb-3">
                        @foreach($post->tags as $tag)
                            <a class="inline bg-gray-300 py-1 px-2 mr-1 mb-2 rounded-full text-xs lowercase text-gray-700" href="#">#{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection