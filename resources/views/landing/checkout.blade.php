@extends('landing.master')

@section('content')
<div class="bg-gray-50 min-h-screen py-24">
    <div class="container mx-auto px-4 max-w-2xl">
        <h1 class="text-3xl font-bold text-center mb-8 text-teal-700">Formulir Donasi</h1>
        
        <!-- Campaign Summary Card -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 mb-6 flex items-center gap-4">
            <img src="{{ asset('/storage/' . $campaign->foto_campaign) }}" alt="Thumbnail" class="w-20 h-20 rounded-xl object-cover bg-gray-100">
            <div>
                <p class="text-xs text-gray-500 mb-1">Anda akan berdonasi untuk:</p>
                <h3 class="font-bold text-gray-900 leading-tight line-clamp-2">{{ $campaign->judul_campaign }}</h3>
            </div>
        </div>

        <form action="{{ route('donasi.store', $campaign->id) }}" method="POST" class="space-y-6">
            @csrf

            <!-- Donation Amount -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-teal-500 rounded-full"></span>
                    Masukan Nominal Donasi
                </h4>
                <div>
                    <label class="text-xs font-medium text-gray-500 mb-1 block">Nominal Donasi (Rp)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">Rp</span>
                        <input type="number" name="nominal" 
                            class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-100 text-lg font-bold text-gray-800 transition-all placeholder-gray-300"
                            placeholder="Min. 10.000" required min="10000">
                    </div>
                </div>
            </div>

            <!-- Donor Information -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-teal-500 rounded-full"></span>
                    Informasi Donatur
                </h4>

                <div class="space-y-4">
                    @auth
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0d9488&color=fff" class="w-10 h-10 rounded-full">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="nama" value="{{ Auth::user()->name }}">
                        <!-- Auto-filled if @auth (user_id is handled in controller via Auth::user()->id, or hidden input if preferred strict) -->
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @else
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Nama Lengkap</label>
                                <input type="text" name="nama" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-teal-100" placeholder="Nama Anda" required>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Email (Opsional)</label>
                                <input type="email" name="email" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-teal-100" placeholder="email@contoh.com">
                            </div>
                        </div>
                    @endauth

                    <!-- Anon Checkbox (Simple) -->
                    <div class="flex items-center gap-3 pt-2">
                        <input type="checkbox" name="anonim" id="anonim" class="w-5 h-5 text-teal-600 rounded border-gray-300 focus:ring-teal-500">
                        <label for="anonim" class="text-sm font-medium text-gray-700 cursor-pointer select-none">Sembunyikan nama saya (Donasi sebagai Hamba Allah)</label>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-teal-500 rounded-full"></span>
                    Metode Pembayaran
                </h4>
                
                <div class="space-y-3">
                    <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-teal-500 has-[:checked]:bg-teal-50">
                        <input type="radio" name="payment_method" value="bank_transfer" class="w-5 h-5 text-teal-600 border-gray-300 focus:ring-teal-500" checked>
                        <span class="ml-3 font-bold text-gray-700">Transfer Bank (BRI/BCA/Mandiri/BNI)</span>
                    </label>

                    <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-teal-500 has-[:checked]:bg-teal-50">
                        <input type="radio" name="payment_method" value="ewallet" class="w-5 h-5 text-teal-600 border-gray-300 focus:ring-teal-500">
                        <span class="ml-3 font-bold text-gray-700">E-Wallet (GoPay/OVO/Dana/LinkAja)</span>
                    </label>

                    <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-teal-500 has-[:checked]:bg-teal-50">
                        <input type="radio" name="payment_method" value="qris" class="w-5 h-5 text-teal-600 border-gray-300 focus:ring-teal-500">
                        <span class="ml-3 font-bold text-gray-700">QRIS</span>
                    </label>
                </div>
            </div>

            <!-- Support Message -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-teal-500 rounded-full"></span>
                    Dukungan & Doa
                </h4>
                <textarea name="pesan" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-teal-100 placeholder-gray-400" placeholder="Tuliskan doa atau dukungan Anda (Opsional)..."></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-teal-500/30 transition-all transform hover:-translate-y-1 text-lg">
                Lanjutkan Pembayaran
            </button>
            <p class="text-center text-xs text-gray-400">Pembayaran aman & terverifikasi oleh Midtrans</p>

        </form>
    </div>
</div>
@endsection
