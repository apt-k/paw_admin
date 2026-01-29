<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Paw's Care</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-100">

@php
    use Illuminate\Support\Facades\Request;
    use Illuminate\Support\Facades\Auth;

    $admin = Auth::guard('admin')->user();
@endphp


{{-- ================= SIDEBAR ================= --}}
<aside
    id="sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen
           bg-white border-r shadow
           transform -translate-x-full
           transition-transform duration-300">

    {{-- PROFILE ADMIN --}}
    <div class="flex flex-col items-center text-center mt-8 mb-10">
        <img
            src="{{ $admin && $admin->foto
                ? asset('profile/admin/' . $admin->foto)
                : asset('profile/default.png') }}"
            class="w-20 h-20 rounded-full object-cover border mb-3">

        <h2 class="font-semibold text-gray-800">
            {{ $admin->name ?? 'Admin Paw’s Care' }}
        </h2>
    </div>

    {{-- MENU --}}
    <nav class="px-4 space-y-1">

        <a href="{{ url('/admin/dashboard') }}"
           class="block px-4 py-2 rounded-lg transition
           {{ Request::is('admin/dashboard')
                ? 'bg-amber-100 text-amber-800 font-semibold'
                : 'text-gray-700 hover:bg-amber-50' }}">
            Dashboard
        </a>

        {{-- DATA --}}
        <div>
            <button
                onclick="toggleDataMenu()"
                class="w-full flex justify-between items-center px-4 py-2 rounded-lg transition
                {{ Request::is('admin/data/*')
                    ? 'bg-amber-100 text-amber-800 font-semibold'
                    : 'text-gray-700 hover:bg-amber-50' }}">
                <span>Data</span>
                <span>▾</span>
            </button>

            <div id="dataMenu"
                 class="ml-4 mt-2 space-y-1 {{ Request::is('admin/data/*') ? '' : 'hidden' }}">

                <a href="{{ url('/admin/data/karyawan') }}"
                   class="block px-4 py-2 text-sm rounded transition
                   {{ Request::is('admin/data/karyawan')
                        ? 'bg-amber-100 text-amber-800 font-semibold'
                        : 'text-gray-700 hover:bg-amber-50' }}">
                    Data Karyawan
                </a>

                <a href="{{ url('/admin/data/hewan') }}"
                   class="block px-4 py-2 text-sm rounded transition
                   {{ Request::is('admin/data/hewan')
                        ? 'bg-amber-100 text-amber-800 font-semibold'
                        : 'text-gray-700 hover:bg-amber-50' }}">
                    Data Hewan
                </a>

                <a href="{{ url('/admin/data/pelayanan') }}"
                   class="block px-4 py-2 text-sm rounded transition
                   {{ Request::is('admin/data/pelayanan')
                        ? 'bg-amber-100 text-amber-800 font-semibold'
                        : 'text-gray-700 hover:bg-amber-50' }}">
                    Data Pelayanan
                </a>
            </div>
        </div>

        <a href="{{ url('/admin/history') }}"
           class="block px-4 py-2 rounded-lg transition
           {{ Request::is('admin/history*')
                ? 'bg-amber-100 text-amber-800 font-semibold'
                : 'text-gray-700 hover:bg-amber-50' }}">
            History
        </a>

        <a href="{{ url('/admin/faq') }}"
           class="block px-4 py-2 rounded-lg transition
           {{ Request::is('admin/faq*')
                ? 'bg-amber-100 text-amber-800 font-semibold'
                : 'text-gray-700 hover:bg-amber-50' }}">
            FAQ
        </a>

        <a href="{{ url('/admin/setting') }}"
           class="block px-4 py-2 rounded-lg transition
           {{ Request::is('admin/setting*')
                ? 'bg-amber-100 text-amber-800 font-semibold'
                : 'text-gray-700 hover:bg-amber-50' }}">
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

    function toggleDataMenu() {
        document.getElementById('dataMenu').classList.toggle('hidden');
    }
</script>

</body>
</html>
