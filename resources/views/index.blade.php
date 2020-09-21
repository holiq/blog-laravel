@extends('layouts.app')
@section('content')
<main class="p-4">
        <div class="flex flex-wrap">
            <div class="w-full md:w-2/3 mb-4">
                <div class="grid md:grid-cols-2 gap-4">
                    @foreach($post as $row)
                    <div class="bg-white rounded shadow hover:shadow-lg transition duration-100 transform hover:-translate-y-1">
                        <img class="h-56 w-full object-cover object-center" src="/images/post/{{ $row->thumbnail }}" alt="{{ $row->title }}">
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
                                <a class="inline bg-gray-200 py-1 px-2 mr-1 mb-2 rounded text-xs lowercase text-gray-700" href="{{ route('blog.tag', $tag->slug) }}">#{{ $tag->name }}</a>
                                @endforeach
                            </div>
                            <div class="flex text-gray-700 text-sm md:text-xs">
                                <div>Posted by <span class="font-semibold">{{ $row->user->name}} </span></div>
                                <span class="px-2">{{ $row->created_at->format('M d, Y') }}</span>
                                <span class="text-red-500">{{ $row->featured ? 'Featured':'' }}</span>
                            </div>
                            <div class="mt-4 flex items-center">
                                <div class="flex mr-2 text-gray-700 text-sm mr-3">
                                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span>{{ $row->views }}</span>
                                </div>
                                <div class="flex mr-2 text-gray-700 text-sm mr-5">
                                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                                    </svg>
                                    <span>{{ $row->countComment->count() }}</span>
                                </div>
                                <div class="flex mr-2 text-gray-700 text-sm mr-4">
                                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
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
                @include('partials.sidebar')
            </div>
        </div>
    </div>
</main>
@endsection