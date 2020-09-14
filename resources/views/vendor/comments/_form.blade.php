<div class="bg-white rounded overflow-hidden shadow">
    <div class="p-4 h-auto">
        @if($errors->has('commentable_type'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('commentable_type') }}
            </div>
        @endif
        @if($errors->has('commentable_id'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('commentable_id') }}
            </div>
        @endif
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            @honeypot
            <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
            <input type="hidden" name="commentable_id" value="{{ $model->getKey() }}" />

            {{-- Guest commenting --}}
            @if(isset($guest_commenting) and $guest_commenting == true)
                <input type="text" class="bg-gray-100 rounded text-gray-600 text-sm leading-normal resize-none w-full py-2 px-3 mb-3 font-medium placeholder-gray-400 focus:outline-none" placeholder="Name *" name="guest_name" />
                @error('guest_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <input type="email" class="bg-gray-100 rounded text-gray-600 text-sm leading-normal resize-none w-full py-2 px-3 mb-3 font-medium placeholder-gray-400 focus:outline-none" placeholder="Name *" name="guest_email" />
                @error('guest_email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            @endif

                <textarea class="bg-gray-100 rounded text-gray-600 text-sm leading-normal resize-none w-full h-24 py-2 px-3 mb-3 font-medium placeholder-gray-400 focus:outline-none" name="message" placeholder="Type Your Comment"></textarea>
                <div class="invalid-feedback">
                    Your message is required.
                </div>
                <small class="form-text text-muted"><a target="_blank" href="https://help.github.com/articles/basic-writing-and-formatting-syntax">Markdown</a> cheatsheet.</small>
            <button type="submit" class="bg-transparent rounded border border-gray-700 text-gray-700 py-2 px-3 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline hover:bg-gray-700 hover:text-white font-semibold">Submit</button>
        </form>
    </div>
</div>
<br />