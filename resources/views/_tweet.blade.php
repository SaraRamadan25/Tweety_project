<div class="flex p-4 {{ $loop->last ? '' : 'border-b border-b-gray-400' }}">
    <div class="mr-2 flex-shrink-0">
        <a href="{{ $tweet->user->path() }}">
            <img
                src="{{ $tweet->user->avatar }}"
                alt=""
                class="rounded-full mr-2"
                width="50"
                height="50"
            >
        </a>
    </div>

    <div>
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
                    <img src="{{ asset('storage/' . $tweet->image) }}"
                         class="rounded-full mr-2"
                         width="250"
                         height="250"
                         style="border-radius: 10px;"
                    >
                </a>
            </div>
        @endif

        @auth
            <x-like-buttons :tweet="$tweet" />
        @endauth
    </div>
</div>
