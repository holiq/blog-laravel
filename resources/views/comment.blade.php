<div class="bg-white rounded overflow-hidden shadow">
    <div class="p-4 h-auto">
        <h4 class="text-gray-700 font-semibold mb-2">Comment</h4>
        @foreach($post->comment as $comment)
        <div class="flex py-3">
            <img class="w-12 h-12 rounded-full object-cover shadow" src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?" alt="avatar">
            <div class="relative w-full ml-4">
                <div class="flex justify-between">
                    <h5 class="font-semibold text-gray-800">{{ $comment->user->name ?? $comment->guest_name }}</h5>
                    <small class="text-sm text-gray-700">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <p class="mt-3 text-gray-700 text-sm">
                    {{ $comment->content }}
                </p>                
                <div class="mt-4 flex items-center">
                    @can('reply-comment', $comment)
                    <div class="flex mr-2 text-gray-700 text-sm mr-3">
                        Reply
                    </div>
                    @endcan
                    @can('edit-comment', $comment)
                    <div class="flex mr-2 text-gray-700 text-sm mr-3">
                        Edit
                    </div>
                    @endcan
                    @can('delete-comment', $comment)
                    <div class="flex mr-2 text-gray-700 text-sm mr-3">
                        Delete
                    </div>
                    @endcan
                </div>
            </div>
        </div>
        @endforeach
        <h6 class="my-2 font-semibold">Leave a reply</h6>
        <p class="text-gray-600 text-sm mb-4">Your email address will not be published. Required fields marked *</p>
        <form method="post" action="{{ route('comment.store') }}">
            @csrf
            @method('post')
            <input type="hidden" name="commentable_type" value="\{{ get_class($post) }}" />
            <input type="hidden" name="commentable_id" value="{{ $post->getKey() }}" />
            <input type="hidden" name="comment_id" value="">
            @guest
            <input type="text" name="name" class="bg-gray-100 rounded text-gray-600 text-sm leading-normal resize-none w-full py-2 px-3 mb-3 font-medium placeholder-gray-400 focus:outline-none" placeholder="Name *">
            <input type="email" name="email" class="bg-gray-100 rounded text-gray-600 text-sm leading-normal resize-none w-full py-2 px-3 mb-3 font-medium placeholder-gray-400 focus:outline-none" placeholder="Email *">
            @endguest
            <textarea class="bg-gray-100 rounded text-gray-600 text-sm leading-normal resize-none w-full h-24 py-2 px-3 mb-3 font-medium placeholder-gray-400 focus:outline-none" name="content" placeholder="Type Your Comment" required></textarea>
            <input type="submit" class="bg-transparent rounded border border-gray-700 text-gray-700 py-2 px-3 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline hover:bg-gray-700 hover:text-white font-semibold" value="Comment">
        </form>
        @guest
        <div class="text-gray-600 text-md leading-normal">
            Please login to comment in this post
        </div>
        @endguest
    </div>
</div>