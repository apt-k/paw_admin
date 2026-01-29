@extends('user.layout.master')

@section('title', 'Notifikasi')

@section('content')
<h2 class="text-2xl font-bold mb-6">Notifikasi Kamu</h2>

<div class="space-y-4">
    @forelse($notifications as $notif)
        <div class="flex justify-between items-start p-4 border-l-4
                    rounded-lg shadow-sm
                    {{ $notif->is_read ? 'border-gray-300 bg-gray-50' : 'border-blue-500 bg-blue-50' }}">
            <div>
                <h3 class="font-semibold text-gray-800">{{ $notif->title }}</h3>
                <p class="text-gray-700 text-sm">{{ $notif->message }}</p>
                <span class="text-xs text-gray-500">{{ $notif->created_at->diffForHumans() }}</span>
            </div>

            @if(!$notif->is_read)
                <a href="{{ route('user.notifications.read', $notif->id) }}"
                   class="ml-4 px-2 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600">
                    Tandai dibaca
                </a>
            @endif
        </div>
    @empty
        <p class="text-gray-500">Belum ada notifikasi.</p>
    @endforelse
</div>
@endsection
