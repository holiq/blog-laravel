@extends('layouts.app')

@section('content')
        <!-- component -->
<main class="py-4">
    <div class="px-4">
        <div class="flex flex-wrap">
            <div class="w-full md:w-2/3 mb-8 px-2">
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-white rounded overflow-hidden shadow hover:shadow-lg transition duration-200 transform hover:-translate-y-2">
                        <img class="h-56 w-full object-cover object-center" src="https://images.unsplash.com/photo-1457282367193-e3b79e38f207?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1654&q=80" alt="">
                        <div class="p-4 h-auto">
                            <a href="#" class="block text-blue-500 hover:text-blue-600 font-semibold mb-2 text-lg md:text-base lg:text-lg">
                                Woman standing under blue sky
                            </a>
                            <div class="text-gray-600 text-sm leading-relaxed block md:text-xs lg:text-sm">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quidem blanditiis unde asperiores? Officia amet perspiciatis ad quibusdam incidunt eaque, nobis, eveniet neque porro id commodi quisquam debitis!
                            </div>
                            <div class="relative mt-2 lg:absolute bottom-0 mb-4 block lg:block">
                                <a class="inline bg-gray-300 py-1 px-2 rounded-full text-xs lowercase text-gray-700" href="#">#something</a>
                                <a class="inline bg-gray-300 py-1 px-2 rounded-full text-xs lowercase text-gray-700" href="#">#sky</a>
                            </div>
                            <div class="mt-4 flex items-center">
                                <div class="flex mr-2 text-gray-700 text-sm mr-3">
                                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                     </svg>
                                     <span>12</span>
                                </div>
                                <div class="flex mr-2 text-gray-700 text-sm mr-5">
                                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                                     </svg>
                                     <span>8</span>
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
                    <div class="bg-white rounded overflow-hidden shadow hover:shadow-lg transition duration-200 transform hover:-translate-y-2">
                        <img class="h-56 w-full object-cover object-center" src="https://images.unsplash.com/photo-1457282367193-e3b79e38f207?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1654&q=80" alt="">
                        <div class="p-4 h-auto">
                            <a href="#" class="block text-blue-500 hover:text-blue-600 font-semibold mb-2 text-lg md:text-base lg:text-lg">
                                Woman standing under blue sky
                            </a>
                            <div class="text-gray-600 text-sm leading-relaxed block md:text-xs lg:text-sm">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quidem blanditiis unde asperiores? Officia amet perspiciatis ad quibusdam incidunt eaque, nobis, eveniet neque porro id commodi quisquam debitis!
                            </div>
                            <div class="relative mt-2 lg:absolute bottom-0 mb-4 block lg:block">
                                <a class="inline bg-gray-300 py-1 px-2 rounded-full text-xs lowercase text-gray-700" href="#">#something</a>
                                <a class="inline bg-gray-300 py-1 px-2 rounded-full text-xs lowercase text-gray-700" href="#">#sky</a>
                            </div>
                            <div class="mt-4 flex items-center">
                                <div class="flex mr-2 text-gray-700 text-sm mr-3">
                                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                     </svg>
                                     <span>12</span>
                                </div>
                                <div class="flex mr-2 text-gray-700 text-sm mr-5">
                                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                                     </svg>
                                     <span>8</span>
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
                </div>
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
                        <div class="grid grid-cols-3 md:grid-cols-2 gap-2">
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                            <a class="bg-gray-300 py-1 px-2 rounded text-xs lowercase text-gray-700" href="#">#sky</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
