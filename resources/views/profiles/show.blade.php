@if(Session::has('success'))
    <div class="bg-green-500 text-white p-4 rounded-md shadow-md flex items-center">
        <strong class="mr-2">Success!</strong>
        <span>{{ Session::get('success') }}</span>
        <button type="button" class="ml-2" onclick="this.parentElement.style.display='none';">&times;</button>
    </div>
@endif

<x-app>
    <header class="mb-6 relative">
        <div class="relative">
            <img src="{{ asset('storage/' . $user->banner) }}"
                 alt="User Banner"
                 width="100%"
                 class="mb-2"
            >


            <img src="{{ $user->avatar }}"
                 alt=""
                 class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
                 style="left: 50%"
                 width="150"
            >
        </div>

        <div class="flex justify-between items-center mb-6">
            <div style="max-width: 270px">
                <h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
                <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex">
                @can('edit',$user)
                <a href="{{ $user->path('edit') }}"
                   class="rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2"
                >
                    Edit Profile
                </a>
                @endcan

                <x-follow-button :user="$user"></x-follow-button>
            </div>
        </div>

        <p class="text-sm">
        {{ $user->description }}
        </p>


    </header>

    @include ('_timeline', [
        'tweets' => $tweets
    ])
</x-app>
