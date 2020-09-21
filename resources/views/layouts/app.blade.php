<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEO::generate() !!}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('package/font-awesome/css/all.min.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
    <div id="app">
        <nav x-data="{ open: false }" class="flex flex-col max-w-screen-xl mx-auto md:mb-4 md:items-center md:justify-between md:flex-row md:px-6 lg:px-8 bg-white shadow">
            <div class="flex flex-row items-center justify-between p-4">
                <a href="{{ route('blog.index') }}" class="text-xl font-semibold tracking-widest text-gray-900 uppercase rounded-lg focus:outline-none">{{ config('app.name', 'Laravel') }}</a>
                <button @click="open = !open" class="rounded-md md:hidden focus:outline-none focus:shadow-outline">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div :class="{'absolute': open, 'hidden': !open}" class="hidden flex flex-col z-10 w-full p-4 mt-12 md:p-0 md:mt-0 md:relative md:flex md:justify-end md:flex-row md:items-center bg-white shadow md:shadow-none">
                <a class="bg-gray-100 text-gray-700 text-base font-medium tracking-tighter rounded-md px-3 py-2 my-1 md:mx-2 focus:outline-none focus:shadow-outline" href="#">Home</a>
                <a class="bg-transparent text-gray-700 text-base font-medium tracking-tighter rounded-md px-3 py-2 my-1 md:mx-2 hover:bg-gray-100 focus:outline-none focus:shadow-outline" href="#">About</a>
                <a class="bg-transparent text-gray-700 text-base font-medium tracking-tighter rounded-md px-3 py-2 my-1 md:mx-2 hover:bg-gray-100 focus:outline-none focus:shadow-outline" href="#">Contact</a>
                @guest
                <div class="flex flex-row items-center justify-between">
                    <a class="bg-blue-500 text-white text-base font-medium tracking-tighter rounded-md px-3 py-2 my-1 md:mx-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                    <a class="bg-transparent text-gray-700 text-base font-medium tracking-tighter border border-gray-700 rounded-md px-3 py-2 my-1 md:mx-2 transition duration-300 ease-in-out hover:bg-gray-700 hover:text-white focus:outline-none focus:shadow-outline" href="{{ route('register') }}">{{ __('Register') }}</a>
                </div>
                @endif
                @else
                <div @click.away="open = false" x-data="{ open: false }">
                    <button @click="open = !open" class="flex flex-row items-center bg-transparent text-gray-700 text-base font-medium tracking-tighter rounded-md px-3 py-2 my-1 md:mx-2 hover:bg-gray-100 focus:outline-none focus:shadow-outline w-full md:w-auto">
                        <span>{{ Auth::user()->name }}</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="rounded-md md:absolute md:w-48 md:right-0 z-30">
                        <div class="px-3 py-2 md:mt-2 md:shadow bg-white rounded-md">
                            <a href="{{ route('logout') }}"  class="block px-3 py-2 md:m-0 mt-2 text-sm text-red-500 font-semibold bg-transparent rounded-md hover:text-red-600 hover:bg-gray-100 focus:outline-none focus:shadow-outline" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
                @endguest
            </div>
        </nav>
        <!-- End Navbar -->
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('package/eruda/eruda.min.js') }}"></script>
    <script>eruda.init();</script>
    @stack('javascript')
</body>
</html>
