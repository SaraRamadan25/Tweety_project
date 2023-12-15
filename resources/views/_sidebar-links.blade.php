<ul>
    <li>
        <a class="font-bold text-lg mb-4 block" href="{{ route('home') }}">Home</a>
    </li>

    <li>
        <a class="font-bold text-lg mb-4 block" href="/explore">Explore</a>
    </li>

    @auth
        <li>
            <a class="font-bold text-lg mb-4 block" href="{{ current_user()->path() }}">Profile</a>
        </li>

        <li>
            <form method="POST" action="/logout">
                @csrf
                <button class="font-bold text-lg">Logout</button>
            </form>
        </li>

        @php
            $notificationCount = Auth::user()->notifications->count();
        @endphp

        <li>
            <a class="font-bold text-lg mb-4 block relative" href="{{ route('notifications.index') }}">
                Notifications
                @if ($notificationCount > 0)
                    <span class="bg-blue-400 text-xs text-black rounded-full px-2 py-1">{{ $notificationCount }}</span>
                @endif
            </a>
        </li>
    @endauth
</ul>
