@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="mt-8">
            <h1 class="text-2xl font-bold mb-4">Notifications</h1>

            @forelse(Auth::user()->notifications as $notification)
                <div class="bg-white p-4 mb-4 shadow-md">
                    @if($notification->data['message'])
                        <p class="mb-2">{{ $notification->data['message'] }}</p>
                    @else
                        <p class="mb-2">Notification content not available.</p>
                    @endif

                    <small class="text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            @empty
                <p>No notifications at the moment.</p>
            @endforelse
        </div>
    </div>
@endsection
