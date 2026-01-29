<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Paw’s Care</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-100">

@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Request;

    $user = Auth::user(); // KONSUMEN
    $unread = $user->notifications()->where('is_read', 0)->count();
@endphp

{{-- ================= SIDEBAR USER ================= --}}
<aside
    id="sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen
           bg-white border-r shadow
           transform -translate-x-full
           transition-transform duration-300">

    {{-- PROFILE USER --}}
    <div class="flex flex-col items-center text-center mt-8 mb-10">
        <img src="{{ $user->photo 
            ? asset('profile/user/' . $user->id . '/' . $user->photo)
            : asset('images/default-avatar.png') }}"
             class="w-20 h-20 rounded-full object-cover border mb-3">

        <h2 class="font-semibold text-gray-800">{{ $user->nama_pemilik }}</h2>
        <p class="text-xs text-gray-500">Konsumen Paw’s Care</p>
    </div>

    {{-- MENU --}}
    <nav class="px-4 space-y-1">

        {{-- HOME --}}
        <a href="{{ route('user.dashboard') }}"
           class="block px-4 py-2 rounded-lg transition
           {{ Request::routeIs('user.dashboard') 
                ? 'bg-amber-100 text-amber-800 font-semibold'
                : 'text-gray-700 hover:bg-amber-50 hover:text-amber-800' }}">
            Home
        </a>

        {{-- NOTIFIKASI --}}
        <a href="{{ route('user.notifications') }}"
           class="relative block px-4 py-2 rounded-lg transition
           {{ Request::routeIs('user.notifications') 
                ? 'bg-amber-100 text-amber-800 font-semibold'
                : 'text-gray-700 hover:bg-amber-50 hover:text-amber-800' }}">
            Notifikasi
            @if($unread > 0)
                <span class="absolute top-3 right-4 inline-block w-3 h-3 bg-blue-500 rounded-full"></span>
            @endif
        </a>

        {{-- SETTING --}}
        <a href="{{ route('user.setting') }}"
           class="block px-4 py-2 rounded-lg transition
           {{ Request::routeIs('user.setting') 
                ? 'bg-amber-100 text-amber-800 font-semibold'
                : 'text-gray-700 hover:bg-amber-50 hover:text-amber-800' }}">
            Setting
        </a>

    </nav>
</aside>

{{-- ================= MAIN CONTENT ================= --}}
<div id="mainContent" class="transition-all duration-300">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b shadow-sm px-6 py-4 flex items-center justify-between relative sticky top-0 z-50">

        <button id="burgerBtn" class="text-2xl">
            ☰
        </button>

        <h1 class="text-lg font-bold absolute left-1/2 -translate-x-1/2">
            Paw’s Care
        </h1>

        <form method="POST" action="/logout">
            @csrf
            <button class="text-red-600 font-medium hover:underline">
                Logout
            </button>
        </form>
    </nav>

    {{-- CONTENT --}}
    <main class="p-6">
        @yield('content')
    </main>

</div>

{{-- ================= SCRIPT ================= --}}
<script>
    const burger = document.getElementById('burgerBtn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    burger.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        mainContent.classList.toggle('ml-64');
    });
</script>

</body>
</html>
