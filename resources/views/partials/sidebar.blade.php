<div class="bg-white rounded overflow-hidden shadow p-4 mb-4">
    <div class="h-auto mb-4">
        <h3 class="font-semibold mb-3">Popular Post</h3>
        @foreach($popular as $row)
        <div class="flex flex-wrap">
            <div class="w-2/5 md:w-2/6 mb-4">
                <img class="w-full h-32 md:h-full object-cover object-center" src="/images/post/{{ $row->thumbnail }}" alt="{{ $row->title }}">
            </div>
            <div class="w-3/5 md:w-4/6 pl-3">
                <a href="{{ route('post', $row->slug) }}" class="block text-gray-900 font-semibold mb-2 text-lg md:text-base lg:text-lg">
                    {{ Str::limit($row->title, 35) }}
                </a>
                <div class="text-gray-600 text-sm leading-relaxed block md:text-xs lg:text-sm">
                    {{ Str::limit(strip_tags($row->content), 100) }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="h-auto mb-4">
        <div class="flex justify-between">
            <h3 class="font-semibold mb-3">Featured Post</h3>
            <a href="#" class="text-gray-700 font-medium text-base">More</a>
        </div>
        @foreach($featured as $row)
        <div class="flex flex-wrap">
            <div class="w-2/5 md:w-2/6 mb-4">
                <img class="w-full h-32 md:h-full object-cover object-center" src="/images/post/{{ $row->thumbnail }}" alt="{{ $row->title }}">
            </div>
            <div class="w-3/5 md:w-4/6 pl-3">
                <a href="{{ route('post', $row->slug) }}" class="block text-gray-900 font-semibold mb-2 text-lg md:text-base lg:text-lg">
                    {{ Str::limit($row->title, 35) }}
                </a>
                <div class="text-gray-600 text-sm leading-relaxed block md:text-xs lg:text-sm">
                    {{ Str::limit(strip_tags($row->content), 100) }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    
    
</div>
<div class="bg-white rounded overflow-hidden shadow p-4 mb-4">
    <div class="h-auto mb-4">
        <h3 class="font-semibold mb-3">Category</h3>
        <div class="flex justify-left flex-wrap">
            @foreach($category as $row)
            <a class="bg-gray-200 py-1 px-2 rounded text-xs lowercase text-gray-700 mr-1 mb-1" href="{{ route('blog.category', $row->slug) }}">{{ $row->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="h-auto mb-4">
        <h3 class="font-semibold mb-3">Tags</h3>
        <div class="flex justify-left flex-wrap break-all">
            @foreach($tags as $row)
            <a class="bg-gray-200 py-1 px-2 rounded text-xs lowercase text-gray-700 mr-1 mb-1" href="{{ route('blog.tag', $row->slug) }}">#{{ $row->name }}</a>
            @endforeach
        </div>
    </div>
    
    
</div>
<div class="bg-white rounded overflow-hidden shadow p-4 mb-4">
    <div class="h-auto mb-4">
        <h3 class="antialiased text-gray-700 font-semibold tracking-wide mb-2">Get the latest update</h3>
        <h5 class="antialiased text-600 tracking-tight">Subscribe now to get the latest events and news.</h5>
        <form action="#" method="post">
            <div class="mt-3 flex flex-row flex-wrap">
                @csrf
                @method('post')
                <input type="text"class="w-2/3 bg-gray-100 rounded-l text-gray-600 text-sm leading-normal resize-none py-2 px-3 font-medium placeholder-gray-400 focus:outline-none" placeholder="email@example.com"/>
                <input type="submit" class="p-1 w-1/3 bg-indigo-500 rounded-r text-white transition duration-300 ease-in-out focus:outline-none focus:shadow-outline hover:bg-indigo-600 font-medium" value="Subscribe">
            </div>
        </form>
    </div>
    
    
</div>