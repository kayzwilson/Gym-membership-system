@extends('layouts.app')
@section('title', 'Notifications')
@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-700">Notifications</h2>
    <form method="POST" action="{{ route('notifications.readAll') }}">
        @csrf
        <button type="submit"
            class="px-5 py-2 text-white font-semibold rounded-lg shadow"
            style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
            <i class="fas fa-check-double mr-2"></i>Mark All Read
        </button>
    </form>
</div>

<div class="space-y-4">
    @forelse($notifications as $notification)
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-start justify-between
        {{ !$notification->is_read ? 'border-l-4' : '' }}"
        style="{{ !$notification->is_read ? 'border-left-color: #FF6B35' : '' }}">
        <div class="flex items-start space-x-4">
            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                 style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                <i class="fas
                    {{ $notification->type === 'membership_expiry' ? 'fa-id-card' :
                       ($notification->type === 'payment_reminder' ? 'fa-credit-card' :
                       ($notification->type === 'session_reminder' ? 'fa-calendar' : 'fa-bell')) }}
                    text-white text-sm"></i>
            </div>
            <div>
                <p class="font-bold text-gray-800">{{ $notification->title }}</p>
                <p class="text-gray-600 text-sm mt-1">{{ $notification->message }}</p>
                <p class="text-gray-400 text-xs mt-2">{{ $notification->created_at->diffForHumans() }}</p>
            </div>
        </div>
        <div class="flex items-center space-x-2 ml-4">
            @if(!$notification->is_read)
            <form method="POST" action="{{ route('notifications.read', $notification) }}">
                @csrf
                <button type="submit"
                    class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-lg hover:bg-green-200">
                    <i class="fas fa-check mr-1"></i>Read
                </button>
            </form>
            @endif
            <form method="POST" action="{{ route('notifications.destroy', $notification) }}"
                  onsubmit="return confirm('Delete this notification?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-3 py-1 bg-red-100 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-200">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-xl shadow-sm p-12 text-center">
        <i class="fas fa-bell text-5xl mb-4 block text-gray-300"></i>
        <p class="text-gray-500">No notifications yet</p>
    </div>
    @endforelse
</div>

<div class="mt-6">{{ $notifications->links() }}</div>
@endsection
