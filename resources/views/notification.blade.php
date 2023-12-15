@foreach($notifications as $notification)
    <div class="bg-white p-4 mb-4 shadow-md rounded-md">
        <p class="text-lg font-semibold mb-2">{{ $notification->message }}</p>
        <small class="text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>
    </div>
@endforeach
