<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Paw’s Care</title>

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
                Register Konsumen
            </p>
        </div>

        {{-- ERROR VALIDATION --}}
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600 bg-red-50 p-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM REGISTER --}}
        <form method="POST" action="/register" class="space-y-4">
            @csrf

            <div>
                <label class="text-sm text-gray-600">Nama Pemilik</label>
                <input
                    type="text"
                    name="nama_pemilik"
                    value="{{ old('nama_pemilik') }}"
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-amber-200">
            </div>

            <div>
                <label class="text-sm text-gray-600">No HP</label>
                <input
                    type="text"
                    name="no_hp"
                    value="{{ old('no_hp') }}"
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-amber-200">
            </div>

            <div>
                <label class="text-sm text-gray-600">Alamat</label>
                <textarea
                    name="alamat"
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-amber-200"
                    rows="3">{{ old('alamat') }}</textarea>
            </div>

            <div>
                <label class="text-sm text-gray-600">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-amber-200">
            </div>

            <div>
                <label class="text-sm text-gray-600">Password</label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-amber-200">
            </div>

            <button
                type="submit"
                class="w-full bg-amber-500 hover:bg-amber-600
                       text-white font-semibold py-2 rounded-lg transition">
                Register
            </button>
        </form>

        {{-- FOOTER --}}
        <p class="text-center text-xs text-gray-400 mt-6">
            Sudah punya akun?
            <a href="/login" class="text-amber-600 hover:underline">
                Login
            </a>
        </p>

    </div>

</body>
</html>
