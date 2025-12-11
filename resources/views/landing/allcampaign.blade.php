@extends('landing.master')
@section('content')
    <!-- Header -->
    <section class="py-12 bg-teal-50">
        <div class="container mx-auto px-4 max-w-6xl text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Semua Program Donasi</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Mari bantu mereka yang membutuhkan dengan menyisihkan sebagian rezeki kita. Pilih program kebaikan yang ingin Anda bantu.</p>
        </div>
    </section>

    <!-- Campaign Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($campaign as $item)
                    <a href="/campaign/{{ $item->slug_campaign }}" class="group block h-full">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden h-full hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('/storage/' . $item->foto_campaign) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $item->judul_campaign }}">
                                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary-600 shadow-sm">
                                    {{ $item->kategori->nama_kategori ?? 'Umum' }}
                                </div>
                            </div>
                            <div class="p-5 flex flex-col h-full">
                                <h5 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors">{{ $item->judul_campaign }}</h5>
                                <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ Str::limit(strip_tags($item->deskripsi_campaign), 80) }}</p>
                                
                                <div class="mt-auto">
                                    <div class="w-full bg-gray-100 rounded-full h-2.5 mb-2">
                                        <div class="bg-primary-500 h-2.5 rounded-full" style="width: {{ ($item->dana_terkumpul / $item->target_campaign) * 100 }}%"></div>
                                    </div>
                                    
                                    <div class="flex justify-between items-end mt-2">
                                        <div>
                                            <p class="text-xs text-gray-500">Terkumpul</p>
                                            <p class="text-sm font-bold text-primary-600">Rp{{ number_format($item->dana_terkumpul, 0, ',', '.') }}</p>
                                        </div>
                                            <div class="text-right">
                                            <p class="text-xs text-gray-500">Target</p>
                                            <p class="text-xs font-semibold text-gray-700">Rp{{ number_format($item->target_campaign, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
