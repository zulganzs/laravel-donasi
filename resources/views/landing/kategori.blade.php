@extends('landing.master')
@section('content')
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <h5 class="text-3xl font-bold text-primary-600">
                    Kategori: 
                    @if ($kat == 1) Pendidikan
                    @elseif ($kat == 2) Sosial
                    @elseif ($kat == 3) Kesehatan
                    @endif
                </h5>
                <a href="/" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-full hover:bg-primary-700 transition-colors shadow-lg shadow-primary-500/30">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($campaign as $item)
                    <a href="/campaign/{{ $item->slug_campaign }}" class="group block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-1">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('/storage/' . $item->foto_campaign) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" alt="{{ $item->judul_campaign }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="p-6">
                            <h5 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors">{{ $item->judul_campaign }}</h5>
                            
                            <div class="w-full bg-gray-100 rounded-full h-2.5 mb-4 overflow-hidden">
                                <div class="bg-primary-500 h-2.5 rounded-full" style="width:{{ ($item->dana_terkumpul / $item->target_campaign) * 100 }}%"></div>
                            </div>
                            
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Terkumpul</p>
                                    <p class="font-bold text-primary-600">Rp{{ number_format($item->dana_terkumpul, 2, ',', '.') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500 mb-1">Sisa Hari</p>
                                    <p class="font-semibold text-gray-700">
                                        {{ \Carbon\Carbon::parse($item->tgl_akhir_campaign)->diffInDays(now()) }} Hari
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $campaign->links() }}
            </div>
        </div>
    </section>
@endsection
@section('script')
@endsection
