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
                
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Reset Password</h1>
                <p class="text-gray-500 mb-8">Buat password baru untuk mengamankan akun Anda.</p>

                @if (session()->has('message'))
                    <div class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl mb-6 flex justify-between items-center" role="alert">
                        <span>{{ session('message') }}</span>
                        <button type="button" class="text-red-700 hover:text-red-900" onclick="this.parentElement.remove()">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                <form method="POST" action="/reset-password" class="space-y-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </span>
                            <input disabled type="email" name="emailshow" class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 cursor-not-allowed" value="{{ $email }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <input type="password" name="password" required minlength="8" class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500 focus:ring-opacity-20 transition-colors" placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <label for="password_confirm" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <input type="password" name="password_confirm" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500 focus:ring-opacity-20 transition-colors" placeholder="••••••••">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-primary-500/30 transition-all transform hover:-translate-y-0.5 mt-2">
                        Reset Password
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
                <h2 class="text-4xl font-bold mb-6">Mulai Lembaran Baru</h2>
                <p class="text-lg text-primary-50 leading-relaxed">Amankan akun Anda dan lanjutkan menyebar kebaikan.</p>
            </div>
        </div>
    </div>
@endsection
