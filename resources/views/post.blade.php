@extends('layouts.app')

@section('content')
        <!-- component -->
<main class="pb-4">
    <div class="px-4">
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
                <div class="bg-white rounded overflow-hidden shadow hover:shadow-lg">
                    <div class="p-4 h-auto">
                        <h3 class="font-semibold mb-3">Popular Post</h3>
                        <div class="flex flex-wrap">
                            <div class="w-2/5 mb-4">
                                <img class="h-32 w-full object-cover object-center" src="https://images.unsplash.com/photo-1457282367193-e3b79e38f207?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1654&q=80" alt="">
                            </div>
                            <div class="w-3/5 pl-3">
                                <a href="#" class="block text-blue-500 hover:text-blue-600 font-semibold mb-2 text-lg md:text-base lg:text-lg">
                                    Woman standing under blue sky
                                </a>
                                <div class="text-gray-600 text-sm leading-relaxed block md:text-xs lg:text-sm">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quidem blanditiis unde asperiores?
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="w-2/5 mb-4">
                                {{-- <img class="h-32 w-full object-cover object-center" src="https://images.unsplash.com/photo-1457282367193-e3b79e38f207?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1654&q=80" alt=""> --}}
                                <div class="h-32 bg-gray-400"></div>
                            </div>
                            <div class="w-3/5 pl-3">
                                <a href="#" class="block text-blue-500 hover:text-blue-600 font-semibold mb-2 text-lg md:text-base lg:text-lg">
                                    Woman standing under blue sky
                                </a>
                                <div class="text-gray-600 text-sm leading-relaxed block md:text-xs lg:text-sm">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quidem blanditiis unde asperiores?
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 pb-4 h-auto">
                        <h3 class="font-semibold mb-3">Category</h3>
                        <div class="flex justify-left flex-wrap">
                            @foreach($category as $row)
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700 mr-1 mb-1" href="#">{{ $row->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
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
    
    function addReply(id) {
        var i = document.getElementById( 'reply_body' );
        var d = document.createElement('div');
        d.id = "reply";
        d.innerHTML = i.innerHTML ;
        var p = document.getElementById(id);
        p.appendChild(d);
        document.getElementById('btn-reply').addClass('cursor-not-allowed');

    }
    function removeReply(button) {
        button.parentNode.remove();
    }
</script>