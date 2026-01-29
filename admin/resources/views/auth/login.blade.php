<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Paw’s Care</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap"
          rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-lg">

        {{-- TITLE --}}
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Paw’s Care
            </h1>
            <p class="text-gray-500 text-sm">
                Halaman Login
            </p>
        </div>

        {{-- ERROR --}}
        @if(session('error'))
            <div class="mb-4 text-sm text-red-600 bg-red-50 p-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        {{-- FORM --}}
       <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
        @csrf

        <div>
            <label class="text-sm text-gray-600">Email</label>
            <input
                type="email"
                name="email"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-amber-200"
            >
        </div>

        <div>
            <label class="text-sm text-gray-600">Password</label>
            <input
                type="password"
                name="password"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-amber-200"
            >
        </div>

        <button
            type="submit"
            class="w-full bg-amber-500 hover:bg-amber-600
                text-white font-semibold py-2 rounded-lg transition">
            Login
        </button>
    </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun?
            <a href="/register" class="text-amber-600 hover:underline font-medium">
                Daftar sebagai Konsumen
            </a>
        </p>

        {{-- FOOTER --}}
        <p class="text-center text-xs text-gray-400 mt-6">
            © {{ date('Y') }} Paw’s Care
        </p>

    </div>

</body>
</html>
