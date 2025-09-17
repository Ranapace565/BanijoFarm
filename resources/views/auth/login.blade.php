<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-2xl p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-6">Selamat Datang</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex justify-center mb-4">
            <button onclick="toggleForm('login')" id="btn-login"
                class="w-1/2 py-2 border-b-2 border-blue-600 font-semibold">
                Login
            </button>
            <button onclick="toggleForm('register')" id="btn-register" class="w-1/2 py-2 border-b-2 border-gray-300">
                Pengajuan Akses
            </button>
        </div>

        <!-- Form Login -->
        <form id="form-login" action="{{ url('/login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full border-gray-300 rounded-xl p-2 focus:ring focus:ring-blue-300" required>
            </div>

            <div>
                <label for="password" class="block font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full border-gray-300 rounded-xl p-2 focus:ring focus:ring-blue-300" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-xl hover:bg-blue-700 transition">
                Login
            </button>
        </form>

        <!-- Form Pengajuan Akses -->
        <form id="form-register" action="{{ route('register') }}" method="POST" class="space-y-4 hidden">
            @csrf
            <div>
                <label for="name" class="block font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name"
                    class="w-full border-gray-300 rounded-xl p-2 focus:ring focus:ring-green-300" required>
            </div>

            <div>
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full border-gray-300 rounded-xl p-2 focus:ring focus:ring-green-300" required>
            </div>

            <div>
                <label for="password" class="block font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full border-gray-300 rounded-xl p-2 focus:ring focus:ring-green-300" required>
            </div>

            <div>
                <label for="password_confirmation" class="block font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full border-gray-300 rounded-xl p-2 focus:ring focus:ring-green-300" required>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white p-2 rounded-xl hover:bg-green-700 transition">
                Ajukan Akses
            </button>
        </form>
    </div>

    <script>
        function toggleForm(type) {
            const loginForm = document.getElementById('form-login');
            const registerForm = document.getElementById('form-register');
            const btnLogin = document.getElementById('btn-login');
            const btnRegister = document.getElementById('btn-register');

            if (type === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                btnLogin.classList.add('border-blue-600');
                btnLogin.classList.remove('border-gray-300');
                btnRegister.classList.add('border-gray-300');
                btnRegister.classList.remove('border-blue-600');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                btnLogin.classList.remove('border-blue-600');
                btnLogin.classList.add('border-gray-300');
                btnRegister.classList.remove('border-gray-300');
                btnRegister.classList.add('border-blue-600');
            }
        }
    </script>
</body>

</html>
