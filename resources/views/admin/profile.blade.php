@extends('layouts.master')

@section('content')
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-gray-800">Profil</h3>
        <p class="text-gray-500 mt-1">Perbarui data pribadi Anda</p>
    </div>

    <!-- Alerts -->
    @if (session()->has('message'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-700 border border-green-100 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('salah'))
        <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 border border-red-100 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            {{ session('salah') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Personal Data Form -->
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <h4 class="text-lg font-bold text-gray-900 mb-6">Data Pribadi</h4>
            
            <form method="POST" action="/admin/profil-update" data-parsley-validate class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Nama</label>
                    <input required type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Email</label>
                    <input required type="email" name="email" value="{{ old('email', Auth::user()->email) }}" data-parsley-type="email" data-parsley-error-message="Masukkan format email yang valid." class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Nomor Telepon</label>
                    <input required type="tel" name="phone_number" value="{{ old('phone_number', Auth::user()->phone_number) }}" data-parsley-type="number" data-parsley-error-message="Masukkan format nomor telepon yang valid." class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none" />
                </div>
                <div class="pt-2">
                    <button type="submit" class="w-full bg-primary-600 text-white font-bold py-3 rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-500/30">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Change Password Form -->
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <h4 class="text-lg font-bold text-gray-900 mb-6">Ganti Kata Sandi</h4>

            @if (Auth::user()->google_id == null)
                <form method="POST" action="/admin/password-update" data-parsley-validate class="space-y-6">
                    @csrf
                    <input type="hidden" name="email" value="{{ old('email', Auth::user()->email) }}" />
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Password Sekarang</label>
                        <input type="password" name="password" data-parsley-minlength="8" data-parsley-error-message="Kata sandi minimal 8 karakter." class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Password Baru</label>
                        <input type="password" id="password-baru" name="password_baru" data-parsley-minlength="8" data-parsley-error-message="Kata sandi minimal 8 karakter." class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Konfirmasi Password</label>
                        <input type="password" name="konfirmasi_password" data-parsley-equalto="#password-baru" data-parsley-error-message="Kata sandi tidak cocok." class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none" />
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="w-full bg-primary-600 text-white font-bold py-3 rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-500/30">
                            Update Password
                        </button>
                    </div>
                </form>
            @else
                <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 text-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 text-blue-500 shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-blue-800 font-medium">Akun Terhubung Google</p>
                    <p class="text-blue-600 text-sm mt-2">Anda masuk menggunakan akun Google, sehingga tidak perlu mengubah kata sandi di sini.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="/assets/js/pages/parsley.js"></script>
@endsection
