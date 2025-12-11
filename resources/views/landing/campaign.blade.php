@extends('landing.master')
@section('content')
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                @if(session('success'))
                    <div class="flex items-center p-4 mb-4 text-green-800 rounded-xl bg-green-50 border border-green-200 mx-6 mt-6" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="text-sm font-medium">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                <!-- Banner Image -->
                <div class="relative h-64 md:h-96 w-full">
                    <img src="{{ asset('/storage/' . $campaign->foto_campaign) }}" class="w-full h-full object-cover"
                        alt="Banner Campaign">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6 md:p-10 w-full">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-2 leading-tight">{{ $campaign->judul_campaign }}</h2>
                    </div>
                </div>

                <div class="p-6 md:p-10">
                    <!-- Description -->
                    <div class="prose prose-lg max-w-none text-gray-600 mb-8">
                        {!! str_replace('<img', '<img class="w-full rounded-xl my-4"', $campaign->deskripsi_campaign) !!}
                    </div>
                    
                    <hr class="border-gray-100 my-8">
                    
                    <!-- Progress Bar -->
                    <div class="mb-6">
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-teal-600 h-3 rounded-full transition-all duration-500 ease-out" 
                                style="width: {{ ($campaign->dana_terkumpul / $campaign->target_campaign) * 100 }}%"></div>
                        </div>
                    </div>
                    
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <div class="text-center md:text-left">
                            <p class="text-sm text-gray-500 mb-1">Dana Terkumpul</p>
                            <p class="text-2xl font-bold text-primary-600">
                                Rp {{ number_format($campaign->dana_terkumpul, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-center md:text-left">
                            <p class="text-sm text-gray-500 mb-1">Target Dana</p>
                            <p class="text-2xl font-bold text-gray-800">
                                Rp {{ number_format($campaign->target_campaign, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-center md:text-left">
                            <p class="text-sm text-gray-500 mb-1">Tanggal Berakhir</p>
                            <p class="text-xl font-semibold text-gray-700">
                                {{ date('d M Y', strtotime($campaign->tgl_akhir_campaign)) }}
                            </p>
                        </div>
                    </div>

<div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 mb-10" id="donation-form">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Formulir Donasi</h3>
                        <form action="{{ route('donasi.store', $campaign->id) }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Donation Amount -->
                            <div>
                                <label class="text-sm font-semibold text-gray-700 mb-2 block">Masukan Nominal Donasi</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">Rp</span>
                                    <input type="number" name="nominal" 
                                        class="w-full pl-12 pr-4 py-4 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-50 text-xl font-bold text-gray-800 transition-all placeholder-gray-300"
                                        placeholder="Min. 10.000" required min="10000">
                                </div>
                                <p class="text-xs text-gray-400 mt-2">*Minimal donasi Rp 10.000</p>
                            </div>

                            <!-- Donor Information -->
                            <div class="space-y-4">
                                <label class="text-sm font-semibold text-gray-700 block">Informasi Donatur</label>
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
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                @else
                                    <div class="grid grid-cols-1 gap-4">
                                        <input type="text" name="nama" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-teal-100" placeholder="Nama Lengkap" required>
                                        <input type="email" name="email" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-teal-100" placeholder="Email (Opsional)">
                                    </div>
                                @endauth

                                <div class="flex items-center gap-3 pt-1">
                                    <input type="checkbox" name="anonim" id="anonim" class="w-4 h-4 text-teal-600 rounded border-gray-300 focus:ring-teal-500">
                                    <label for="anonim" class="text-sm text-gray-600 cursor-pointer select-none">Sembunyikan nama saya (Hamba Allah)</label>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div>
                                <label class="text-sm font-semibold text-gray-700 mb-3 block">Metode Pembayaran</label>
                                <div class="space-y-3">
                                    <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-teal-500 has-[:checked]:bg-teal-50">
                                        <input type="radio" name="payment_method" value="bank_transfer" class="w-4 h-4 text-teal-600 border-gray-300 focus:ring-teal-500" checked>
                                        <span class="ml-3 font-medium text-gray-700">Transfer Bank</span>
                                    </label>
                                    <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-teal-500 has-[:checked]:bg-teal-50">
                                        <input type="radio" name="payment_method" value="ewallet" class="w-4 h-4 text-teal-600 border-gray-300 focus:ring-teal-500">
                                        <span class="ml-3 font-medium text-gray-700">E-Wallet</span>
                                    </label>
                                    <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-teal-500 has-[:checked]:bg-teal-50">
                                        <input type="radio" name="payment_method" value="qris" class="w-4 h-4 text-teal-600 border-gray-300 focus:ring-teal-500">
                                        <span class="ml-3 font-medium text-gray-700">QRIS</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Support Message -->
                            <div>
                                <label class="text-sm font-semibold text-gray-700 mb-2 block">Dukungan & Doa</label>
                                <textarea name="pesan" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-teal-100 placeholder-gray-400" placeholder="Tuliskan doa atau dukungan Anda..."></textarea>
                            </div>

                            <button type="submit" class="block w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-teal-500/30 transition-all transform hover:-translate-y-1 text-lg mt-6 relative z-10">
                                Lanjutkan Pembayaran
                            </button>
                            <p class="text-center text-xs text-gray-400">Pembayaran aman & terverifikasi oleh Midtrans</p>
                        </form>
                    </div>

                    <hr class="border-gray-100 my-8">

                    <h6 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="w-1.5 h-8 bg-primary-500 rounded-full mr-3"></span>
                        Berita Campaign
                    </h6>
                    
                    <div class="accordion space-y-3" id="beritaAccordion">
                        <div class="accordion-item border border-gray-200 rounded-xl overflow-hidden bg-white">
                            <h2 class="accordion-header mb-0" id="heading">
                                <button class="accordion-button collapsed relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left bg-white border-0 rounded-none transition focus:outline-none" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse" aria-expanded="false" aria-controls="collapse">
                                    Informasi terbaru mengenai campaign akan diupdate di sini.
                                </button>
                            </h2>
                            @foreach ($berita as $key => $item)
                                <div id="collapse" class="accordion-collapse collapse" aria-labelledby="heading"
                                    data-bs-parent="#beritaAccordion">
                                    <div class="accordion-body py-4 px-5 bg-gray-50 border-t border-gray-100">
                                        <a class="block group"
                                            href="{{ $campaign->slug_campaign }}/berita/{{ $item->slug_berita }}">
                                            <p class="font-bold text-gray-800 group-hover:text-primary-600 transition-colors mb-1">{{ $item->judul_berita }}</p>
                                            <span class="text-sm text-gray-500">{{ $item->tgl_terbit_berita }}</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <hr class="border-gray-100 my-8">

                    <h6 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="w-1.5 h-8 bg-primary-500 rounded-full mr-3"></span>
                        Doa dari Donatur
                    </h6>
                    
                    <div class="space-y-4">
                        @foreach ($doa as $item)
                            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-bold text-gray-800">{{ $item->nama }}</h4>
                                    <span class="text-sm font-semibold text-primary-600 bg-primary-50 px-3 py-1 rounded-full">Rp{{ number_format($item->nominal_transaksi, 2, ',', '.') }}</span>
                                </div>
                                <p class="text-gray-600 italic">"{{ $item->keterangan }}"</p>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection
