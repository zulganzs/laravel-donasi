@extends('layouts.peduli_layout')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Hero/Header Card -->
    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 mb-8 flex flex-col md:flex-row items-center gap-8 relative overflow-hidden">
        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-primary-50 opacity-50 blur-3xl"></div>
        
        <!-- Avatar -->
        <div class="relative z-10">
            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full p-1 bg-white border-2 border-primary-100 shadow-md">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0d9488&color=fff&size=128" alt="{{ $user->name }}" class="w-full h-full rounded-full object-cover">
            </div>
        </div>

        <!-- User Info -->
        <div class="flex-1 text-center md:text-left z-10">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1">{{ $user->name }}</h1>
            <p class="text-gray-500 mb-4">{{ $user->email }}</p>
            
            <!-- Impact Badges -->
            <div class="flex flex-wrap justify-center md:justify-start gap-4">
                <div class="flex items-center gap-3 px-4 py-2 bg-primary-50 rounded-xl border border-primary-100">
                    <div class="p-2 bg-white rounded-full text-primary-600 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Total Donasi</p>
                        <p class="text-lg font-bold text-primary-700">Rp {{ number_format($user_donation_total, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 px-4 py-2 bg-blue-50 rounded-xl border border-blue-100">
                    <div class="p-2 bg-white rounded-full text-blue-600 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Kampanye Didukung</p>
                        <p class="text-lg font-bold text-blue-700">{{ $user_campaign_count }} Program</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabbed Interface -->
    <div x-data="{ activeTab: 'profile' }">
        <div class="flex gap-2 mb-6 overflow-x-auto pb-2 no-scrollbar border-b border-gray-100">
            <button @click="activeTab = 'profile'" :class="{ 'bg-primary-600 text-white shadow-md': activeTab === 'profile', 'bg-white text-gray-600 hover:bg-gray-50': activeTab !== 'profile' }" class="px-6 py-2.5 rounded-xl font-medium transition-all whitespace-nowrap">
                Edit Profil
            </button>
            <button @click="activeTab = 'password'" :class="{ 'bg-primary-600 text-white shadow-md': activeTab === 'password', 'bg-white text-gray-600 hover:bg-gray-50': activeTab !== 'password' }" class="px-6 py-2.5 rounded-xl font-medium transition-all whitespace-nowrap">
                Ganti Password
            </button>
            <a href="{{ url('/donasi-saya') }}" class="px-6 py-2.5 rounded-xl font-medium bg-white text-gray-600 hover:bg-gray-50 transition-all whitespace-nowrap">
                Riwayat Donasi
            </a>
        </div>

        <!-- Alerts -->
        @if (session()->has('message'))
            <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 flex items-center gap-3 border border-green-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('salah'))
            <div class="bg-red-50 text-red-700 p-4 rounded-xl mb-6 flex items-center gap-3 border border-red-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                {{ session('salah') }}
            </div>
        @endif

        <!-- Edit Profile Tab -->
        <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Informasi Pribadi</h2>
                
                <form action="/profil-update" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none text-gray-800 font-medium" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none text-gray-800 font-medium" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Nomor Telepon</label>
                            <input type="tel" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none text-gray-800 font-medium" required>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-primary-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-primary-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password Tab -->
        <div x-show="activeTab === 'password'" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Ganti Kata Sandi</h2>

                @if ($user->google_id == null)
                <form action="/password-update" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    
                    <div class="space-y-6 mb-8 max-w-2xl">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Password Sekarang</label>
                            <input type="password" name="password" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none text-gray-800" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Password Baru</label>
                            <input type="password" name="password_baru" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none text-gray-800" required minlength="8">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasi_password" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none text-gray-800" required>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-primary-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-primary-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            Update Password
                        </button>
                    </div>
                </form>
                @else
                <div class="bg-blue-50 text-blue-700 p-6 rounded-xl border border-blue-100 flex items-start gap-4">
                    <svg class="w-6 h-6 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="font-bold mb-1">Akun Terhubung dengan Google</p>
                        <p class="text-sm opacity-90">Anda masuk menggunakan akun Google, sehingga tidak perlu mengubah kata sandi di sini.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Alpine.js for Tabs -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection
