@foreach($replies as $reply)
@if($reply->parent_id == "")
	@php $margin = 0 @endphp
@else
	@php $margin = 25 @endphp
@endif
<div class="flex py-3" id="comment-{{ $reply->getKey() }}" style="margin-left: {{ $margin }}px">
    <img class="w-12 h-12 rounded-full object-cover shadow" src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?" alt="avatar">
    <div class="relative w-full ml-4">
        <div class="flex justify-between">
            <h5 class="font-semibold text-gray-800" id="commenter_name">{{ $reply->user->name ?? $reply->guest_name }}</h5>
            <small class="text-sm text-gray-700">{{ $reply->created_at->diffForHumans() }}</small>
        </div>
        <div class="mt-3 text-gray-700 text-sm tracking-normal leading-snug">
            @markdown($reply->content)
        </div>
        <div class="flex justify-left flex-wrap mt-4">
            @can('reply-comment', $reply)
            <div class="inline text-gray-700 text-sm mr-3">
                <button class="bg-transparent focus:outline-none" id="btn-reply" onclick="editId('reply-{{ $reply->getKey() }}')">Reply</button>
            </div>
            @endcan
            @can('edit-comment', $reply)
            <div class="inline text-gray-700 text-sm mr-3">
                <button class="bg-transparent focus:outline-none" onclick="editId('edit-{{ $reply->getKey() }}')">Edit</button>
            </div>
            @endcan
            @can('delete-comment', $reply)
            <div class="inline text-red-500 text-sm mr-3">
                <form action="{{ route('comment.destroy', $reply->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="bg-transparent focus:outline-none focus:text-red-700" value="Delete">
                </form>
            </div>
            @endcan
        </div>
        {{-- Form reply --}}
        @can('reply-comment', $reply)
        <div class="hidden" id="reply-{{ $reply->getKey() }}">
            <form action="{{ route('comment.store') }}" method="post">
                @csrf
                @honeypot
                @method('post')
                <input type="hidden" name="commentable_type" value="\{{ get_class($post) }}" />
                <input type="hidden" name="commentable_id" value="{{ $post->getKey() }}" />
                <input type="hidden" name="parent_id" value="{{ $reply->getKey() }}" />
                <textarea class="bg-gray-100 rounded text-gray-600 text-sm leading-normal resize-none w-full h-24 py-2 px-3 my-3 font-medium placeholder-gray-400 focus:outline-none" name="content" placeholder="Type Your Comment" required></textarea>
                <button type="button" class="bg-transparent rounded border border-gray-700 text-md text-gray-700 py-1 px-2 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline hover:bg-gray-700 hover:text-white font-medium" onclick="editId('reply-{{ $reply->getKey() }}')">Cancel</button>
                <input type="submit" class="bg-green-500 rounded border border-green-500 text-md text-white py-1 px-2 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline font-medium" value="Reply">
            </form>
        </div>
        @endcan
        {{-- Form edit --}}
        @can('edit-comment', $reply)
        <div id="edit-{{ $reply->getKey() }}" class="hidden">
            <form action="{{ route('comment.update', $reply->id) }}" method="post">
                @csrf
                @honeypot
                @method('post')
                <input type="hidden" name="commentable_type" value="\{{ get_class($post) }}" />
                <input type="hidden" name="commentable_id" value="{{ $post->getKey() }}" />
                <textarea class="bg-gray-100 rounded text-gray-600 text-sm leading-normal resize-none w-full h-24 py-2 px-3 my-3 font-medium placeholder-gray-400 focus:outline-none" name="content" placeholder="Type Your Comment" required>{{ $reply->content }}</textarea>
                <button type="button" class="bg-transparent rounded border border-gray-700 text-md text-gray-700 py-1 px-2 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline hover:bg-gray-700 hover:text-white font-medium" onclick="editId('edit-{{ $reply->getKey() }}')">Cancel</button>
                <input type="submit" class="bg-green-500 rounded border border-green-500 text-md text-white py-1 px-2 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline font-medium" value="Update">
            </form>
        </div>
        @endcan
        
    </div>
</div>
@include('reply', ['replies' => $reply->replies, 'margin' => $margin])
@endforeach