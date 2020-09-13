@extends('layouts.app')

@section('content')
        <!-- component -->
<main class="py-4">
    <div class="px-4">
        <div class="flex flex-wrap">
            <div class="w-full md:w-2/3 mb-8 px-2">
                <div class="grid md:grid-cols-2 gap-4">
                    @foreach($post as $row)
                    <div class="bg-white rounded overflow-hidden shadow hover:shadow-lg transition duration-100 transform hover:-translate-y-1">
                        <img class="h-56 w-full object-cover object-center" src="/images/post/{{ $row->thumbnail }}" alt="">
                        <div class="p-4 h-auto">
                            <a class="inline-block bg-indigo-700 py-1 px-2 rounded mb-2 text-white text-xs uppercase" href="{{ route('blog.category', $row->category->slug) }}">{{ $row->category->name }}</a>
                            <a href="{{ route('post', $row->slug) }}" class="block text-gray-900 font-semibold mb-2 text-lg md:text-base lg:text-lg">
                                {{ Str::limit($row->title, 40) }}
                            </a>
                            <div class="text-gray-700 text-sm leading-relaxed block md:text-xs lg:text-sm">
                                {{ Str::limit(strip_tags($row->content), 200) }}
                            </div>
                            <div class="flex justify-left flex-wrap mt-2 mb-3">
                                @foreach($row->tags as $tag)
                                <a class="inline bg-gray-200 py-1 px-2 mr-1 mb-2 rounded-full text-xs lowercase text-gray-700" href="{{ route('blog.tag', $tag->slug) }}">#{{ $tag->name }}</a>
                                @endforeach
                            </div>
                            <div class="flex text-gray-700 text-sm">
                                <div>Posted by <span class="font-semibold">{{ $row->user->name}} </span></div>
                                <span class="px-2">{{ $row->created_at->format('M d, Y') }}</span>
                                <span class="text-red-500">{{ $row->featured ? 'Featured':'' }}</span>
                            </div>
                            <div class="mt-4 flex items-center">
                                <div class="flex mr-2 text-gray-700 text-sm mr-3">
                                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span>244</span>
                                </div>
                                <div class="flex mr-2 text-gray-700 text-sm mr-5">
                                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                                    </svg>
                                    <span>25</span>
                                </div>
                                <div class="flex mr-2 text-gray-700 text-sm mr-4">
                                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <span>share</span>
                                </div>
                             </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{ $post->links('vendor.pagination.tailwind') }}
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
