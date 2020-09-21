@extends('layouts.app')
@section('content')
<main class="p-4">
        <div class="flex flex-wrap">
            <div class="w-full md:w-2/3 mb-8">
                <div class="bg-white rounded overflow-hidden shadow mb-4">
                    <img class="h-56 w-full object-cover object-center" src="/images/post/{{ $post->thumbnail }}" alt="">
                    <div class="p-4 h-auto">
                        <a class="inline-block bg-indigo-700 py-1 px-2 rounded mb-2 text-white text-xs uppercase" href="#">{{ $post->category->name }}</a>
                        <h2 class="block text-gray-900 font-semibold mb-2 md:text-base lg:text-lg">
                            {{ $post->title }}
                        </h2>
                        <div class="flex text-gray-700 text-sm my-3">
                            <i class="fa fa-calendar mr-1"></i><div>Posted by <span class="font-semibold">{{ $post->user->name}} </span></div>
                            <span class="px-2">{{ $post->created_at->format('M d, Y') }}</span>
                            <span class="text-red-500">{{ $post->featured ? 'Featured':'' }}</span>
                        </div>
                        <div class="text-gray-700 leading-relaxed">
                            {!! $post->content !!}
                        </div>
                        <h4 class="block text-gray-900 font-semibold my-2 md:text-base lg:text-lg">#Tags</h4>
                        <div class="flex justify-left flex-wrap mt-2 mb-3">
                            @foreach($post->tags as $tag)
                                <a class="inline bg-gray-200 py-1 px-2 mr-1 mb-2 rounded-full text-xs lowercase text-gray-700" href="#">#{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @include('comment', ['comments' => $post->comment])
            </div>
            <div class="w-full md:w-1/3 mb-4 px-2">
                @include('partials.sidebar')
            </div>
        </div>
</main>
@endsection
@push('javascript')
<script>
    function editId(id) {
        document.getElementById(id).classList.toggle("hidden");
        document.getElementById(id).classList.toggle("block");
    }
</script>
@endpush