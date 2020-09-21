<div class="bg-white rounded overflow-hidden shadow">
    <div class="p-4 h-auto">
        <h4 class="text-gray-700 font-semibold mb-2">Comment</h4>
        @forelse($comments as $comment)
        <div class="flex py-3" id="comment-{{ $comment->getKey() }}">
            <img class="w-12 h-12 rounded-full object-cover shadow" src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?" alt="avatar">
            <div class="relative w-full ml-4">
                <div class="flex justify-between">
                    <h5 class="font-semibold text-gray-800">{{ $comment->user->name ?? $comment->guest_name }}</h5>
                    <small class="text-sm text-gray-700">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <div class="mt-3 text-gray-700 text-sm tracking-normal leading-snug">
                    @markdown($comment->content)
                </div>
                <div class="flex justify-left flex-wrap mt-4">
                    @can('reply-comment', $comment)
                    <div class="inline text-gray-700 text-sm mr-3">
                        <button class="bg-transparent focus:outline-none" id="btn-reply" onclick="editId('reply-{{ $comment->getKey() }}')">Reply</button>
                    </div>
                    @endcan
                    @can('edit-comment', $comment)
                    <div class="inline text-gray-700 text-sm mr-3">
                        <button class="bg-transparent focus:outline-none" onclick="editId('edit-{{ $comment->getKey() }}')">Edit</button>
                    </div>
                    @endcan
                    @can('delete-comment', $comment)
                    <div class="inline text-red-500 text-sm mr-3">
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" class="bg-transparent focus:outline-none focus:text-red-700" value="Delete">
                        </form>
                    </div>
                    @endcan
                </div>
                {{-- Form reply --}}
                @can('reply-comment', $comment)
                <div class="hidden" id="reply-{{ $comment->getKey() }}">
                    <form action="{{ route('comment.store') }}" method="post">
                        @csrf
                        @honeypot
                        @method('post')
                        <input type="hidden" name="commentable_type" value="\{{ get_class($post) }}" />
                        <input type="hidden" name="commentable_id" value="{{ $post->getKey() }}" />
                        <input type="hidden" name="parent_id" value="{{ $comment->getKey() }}" />
                        <textarea class="bg-gray-100 rounded text-gray-600 text-sm leading-normal resize-none w-full h-24 py-2 px-3 my-3 font-medium placeholder-gray-400 focus:outline-none" name="content" placeholder="Type Your Comment" required></textarea>
                        <button type="button" class="bg-transparent rounded border border-gray-700 text-md text-gray-700 py-1 px-2 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline hover:bg-gray-700 hover:text-white font-medium" onclick="editId('reply-{{ $comment->getKey() }}')">Cancel</button>
                        <input type="submit" class="bg-green-500 rounded border border-green-500 text-md text-white py-1 px-2 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline font-medium" value="Reply">
                    </form>
                </div>
                @endcan
                {{-- Form edit --}}
                @can('edit-comment', $comment)
                <div id="edit-{{ $comment->getKey() }}" class="hidden">
                    <form action="{{ route('comment.update', $comment->id) }}" method="post">
                        @csrf
                        @method('put')
                        <textarea class="bg-gray-100 rounded text-gray-600 text-sm leading-normal resize-none w-full h-24 py-2 px-3 my-3 font-medium placeholder-gray-400 focus:outline-none" name="content" placeholder="Type Your Comment" required>{{ $comment->content }}</textarea>
                        <button class="bg-transparent rounded border border-gray-700 text-md text-gray-700 py-1 px-2 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline hover:bg-gray-700 hover:text-white font-medium" onclick="editId('edit-{{ $comment->getKey() }}')">Cancel</button>
                        <input type="submit" class="bg-green-500 rounded border border-green-500 text-md text-white py-1 px-2 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline font-medium" value="Update">
                    </form>
                </div>
                @endcan
            </div>
        </div>
        @include('reply', ['replies' => $comment->replies, 'margin' => 0])
        @empty
        <div class="text-gray-500 my-2 text-md leading-normal">
            No comment doesn't exits
        </div>
        @endforelse
        <h6 class="my-2 font-semibold">Leave a comment</h6>
        @guest
        <p class="text-gray-600 text-sm mb-4">Your email address will not be published. Required fields marked *</p>
        @endguest
        <form method="post" action="{{ route('comment.store') }}">
            @csrf
            @honeypot
            @method('post')
            <input type="hidden" name="commentable_type" value="\{{ get_class($post) }}" />
            <input type="hidden" name="commentable_id" value="{{ $post->getKey() }}" />
            @guest
            <input type="text" name="guest_name" class="bg-gray-100 rounded text-gray-600 text-sm leading-normal resize-none w-full py-2 px-3 mb-3 font-medium placeholder-gray-400 focus:outline-none" placeholder="Name *">
            <input type="email" name="guest_email" class="bg-gray-100 rounded text-gray-600 text-sm leading-normal resize-none w-full py-2 px-3 mb-3 font-medium placeholder-gray-400 focus:outline-none" placeholder="Email *">
            @endguest
            <textarea class="bg-gray-100 rounded text-gray-600 text-sm leading-normal resize-none w-full h-24 py-2 px-3 mb-3 font-medium placeholder-gray-400 focus:outline-none" name="content" placeholder="Type Your Comment" required></textarea>
            <input type="submit" class="bg-transparent rounded border border-gray-700 text-gray-700 py-2 px-3 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline hover:bg-gray-700 hover:text-white font-semibold" value="Comment">
        </form>
    </div>
</div>