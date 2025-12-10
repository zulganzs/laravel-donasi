@extends('auth.auth')
@section('content')
    <div class="flex min-h-screen bg-white">
        <!-- Left Side - Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-12 lg:px-24 py-12">
            <div class="max-w-md mx-auto w-full">
                <div class="mb-10">
                    <a href="/">
                        <img src="/assets/images/logo/wecare.png" alt="Logo" class="h-12 w-auto">
                    </a>
                </div>
                
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Lupa Password</h1>
                <p class="text-gray-500 mb-8">Masukkan email Anda dan kami akan mengirimkan link reset password.</p>

                @if (session()->has('message'))
                    <div class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl mb-6 flex justify-between items-center" role="alert">
                        <span>{{ session('message') }}</span>
                        <button type="button" class="text-red-700 hover:text-red-900" onclick="this.parentElement.remove()">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif
                @if (session()->has('sukses'))
                    <div class="bg-green-50 border border-green-100 text-green-700 px-4 py-3 rounded-xl mb-6 flex justify-between items-center" role="alert">
                        <span>{{ session('sukses') }}</span>
                        <button type="button" class="text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                <form method="POST" action="/lupa-password" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </span>
                            <input type="email" name="email" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500 focus:ring-opacity-20 transition-colors" placeholder="nama@email.com">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-primary-500/30 transition-all transform hover:-translate-y-0.5">
                        Kirim Link Reset
                    </button>
                </form>

                <p class="text-center mt-8 text-gray-600">
                    Ingat akun Anda? <a href="/login" class="font-bold text-primary-600 hover:text-primary-700">Masuk</a>
                </p>
            </div>
        </div>

        <!-- Right Side - Image -->
        <div class="hidden lg:flex w-1/2 relative bg-primary-600">
            <img src="/assets/images/bg/clarity-login.png" class="absolute inset-0 w-full h-full object-cover opacity-90" alt="Background">
            <div class="absolute inset-0 bg-gradient-to-br from-primary-600/80 to-teal-800/80 mix-blend-multiply"></div>
            <div class="relative z-10 p-12 text-white max-w-xl">
                <h2 class="text-4xl font-bold mb-6">Kami Siap Membantu</h2>
                <p class="text-lg text-primary-50 leading-relaxed">Jangan khawatir, kami akan membantu Anda mendapatkan kembali akses ke akun Anda.</p>
            </div>
        </div>
    </div>
@endsection
