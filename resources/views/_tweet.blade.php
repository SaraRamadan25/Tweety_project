<div class="flex p-4 {{ $loop->last ? '' : 'border-b border-b-gray-400' }}">
    <div class="mr-2 flex-shrink-0">
        <a href="{{ $tweet->user->path() }}">
            <img src="{{ $tweet->user->avatar }}" alt="" class="rounded-full mr-2" width="50" height="50">
        </a>
    </div>

    <div class="flex-grow"> <!-- Use flex-grow to allow the content to grow and push the delete button to the right -->
        <h5 class="font-bold mb-2">
            <a href="{{ $tweet->user->path() }}">
                {{ $tweet->user->name }}
            </a>
        </h5>

        <!-- Tweet Body -->
        <p class="mb-2">{{ $tweet->body }}</p>

        @if ($tweet->image)
            <div class="mr-2 flex-shrink-0">
                <a href="{{ $tweet->user->path() }}">
                    <img src="{{ asset('storage/' . $tweet->image) }}" class="rounded-full mr-2" width="250" height="250"
                         style="border-radius: 10px;">
                </a>
            </div>
        @endif

        @auth
            <x-like-buttons :tweet="$tweet" />
        @endauth
    </div>

    @auth
        @if(auth()->user()->id === $tweet->user_id)
            <!-- Delete Button -->
            <form id="deleteTweetForm{{ $tweet->id }}" method="post" action="{{ route('tweets.destroy', $tweet) }}">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete('{{ $tweet->id }}')"
                        class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-700">
                    Delete
                </button>
            </form>
        @endif
    @endauth
</div>

<script>
    function confirmDelete(tweetId) {
        if (confirm("Are you sure you want to delete this tweet?")) {
            document.getElementById('deleteTweetForm' + tweetId).submit();
        }
    }
</script>
