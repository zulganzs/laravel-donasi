@extends('layouts.peduli_layout')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 text-center">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Verifikasi Akun</h1>
        <p class="text-gray-500">Lengkapi data diri Anda untuk meningkatkan kepercayaan donatur.</p>
    </div>

    @auth
        @if (is_null($verifikasi))
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <form method="post" action="/kirim-verifikasi-akun" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Nomor KTP</label>
                        <input type="number" name="nomor_ktp" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none text-gray-800" required data-parsley-minlength="16" data-parsley-maxlength="16" data-parsley-error-message="Nomor KTP harus 16 digit.">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Nama Sesuai KTP</label>
                        <input type="text" name="nama_ktp" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none text-gray-800" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none text-gray-800" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Foto KTP</label>
                        <input type="file" name="foto_ktp" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none text-gray-800 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100" required>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-500 mb-2">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition-all outline-none text-gray-800" required></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-primary-600 text-white font-bold py-3 px-10 rounded-xl shadow-lg hover:bg-primary-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 w-full md:w-auto">
                        Kirim Verifikasi
                    </button>
                </div>
            </form>
        </div>
        @else
        <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100 text-center max-w-xl mx-auto">
            <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 
                @if ($verifikasi->status_verifikasi == 0) bg-yellow-50 text-yellow-500
                @elseif ($verifikasi->status_verifikasi == 1) bg-green-50 text-green-500
                @elseif ($verifikasi->status_verifikasi == 2) bg-red-50 text-red-500
                @endif">
                
                @if ($verifikasi->status_verifikasi == 0)
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @elseif ($verifikasi->status_verifikasi == 1)
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                @elseif ($verifikasi->status_verifikasi == 2)
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                @endif
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-2">Status Verifikasi</h2>
            
            @if ($verifikasi->status_verifikasi == 0)
                <p class="text-lg font-semibold text-yellow-600 mb-4">Menunggu Persetujuan</p>
                <p class="text-gray-500">Data Anda sedang ditinjau oleh tim kami. Mohon menunggu 1x24 jam.</p>
            @elseif ($verifikasi->status_verifikasi == 1)
                <p class="text-lg font-semibold text-green-600 mb-4">Verifikasi Berhasil</p>
                <p class="text-gray-500">Selamat! Akun Anda telah terverifikasi. Anda kini dapat membuat campaign dengan lebih terpercaya.</p>
            @elseif ($verifikasi->status_verifikasi == 2)
                <p class="text-lg font-semibold text-red-600 mb-4">Verifikasi Ditolak</p>
                <p class="text-gray-500">Mohon maaf, data yang Anda kirimkan belum sesuai. Silakan hubungi admin untuk informasi lebih lanjut.</p>
            @endif
        </div>
        @endif
    @else
        <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100 text-center max-w-xl mx-auto">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-4">Login Diperlukan</h2>
            <p class="text-gray-500 mb-8">Silakan masuk terlebih dahulu untuk melakukan verifikasi akun.</p>
            <a href="{{ route('login') }}" class="inline-block bg-primary-600 text-white font-bold py-3 px-10 rounded-xl shadow-lg hover:bg-primary-700 transition-colors">
                Masuk Sekarang
            </a>
        </div>
    @endauth
</div>
@endsection

@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="/assets/js/pages/parsley.js"></script>
@endsection
