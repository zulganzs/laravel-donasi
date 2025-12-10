@extends('layouts.peduli_layout')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Riwayat Donasi</h1>
            <p class="text-gray-500 mt-1">Jejak kebaikan yang telah Anda bagikan.</p>
        </div>
        <div class="bg-primary-50 text-primary-700 px-4 py-2 rounded-xl font-semibold text-sm">
            Total: {{ count($transaksi) }} Donasi
        </div>
    </div>

    @if (count($transaksi) > 0)
        <div class="grid gap-4">
            @foreach ($transaksi as $item)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row items-start md:items-center gap-6 hover:shadow-md transition-all duration-300 group">
                    <!-- Campaign Image (Optional, if available in relation) -->
                    {{-- <div class="w-full md:w-24 h-24 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                        <img src="/storage/{{ $item->campaign->foto_campaign }}" class="w-full h-full object-cover">
                    </div> --}}
                    
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs font-medium text-gray-400">{{ date('d M Y', strtotime($item->tgl_transaksi)) }}</span>
                            <span class="text-gray-300">&bull;</span>
                            <span class="text-xs font-medium text-gray-400">ID: #{{ $item->id }}</span>
                        </div>
                        
                        <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-primary-600 transition-colors">
                            <a href="{{ url('/campaign/'.$item->campaign->slug_campaign) }}">
                                {{ $item->campaign->judul_campaign }}
                            </a>
                        </h3>
                        
                        <div class="flex items-center gap-1 text-gray-600">
                            <span class="text-sm">Donasi:</span>
                            <span class="font-bold text-gray-900">Rp {{ number_format($item->nominal_transaksi, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col items-end gap-3 w-full md:w-auto">
                        @if ($item->status_transaksi == 0)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 uppercase tracking-wide">
                                Belum Dibayar
                            </span>
                            <a href="{{ url('/checkout/'.$item->id) }}" class="px-5 py-2 rounded-xl bg-primary-600 text-white text-sm font-bold hover:bg-primary-700 transition-colors shadow-sm">
                                Bayar Sekarang
                            </a>
                        @elseif($item->status_transaksi == 1)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 uppercase tracking-wide">
                                Berhasil
                            </span>
                        @elseif($item->status_transaksi == 2)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 uppercase tracking-wide">
                                Kadaluarsa
                            </span>
                        @elseif($item->status_transaksi == 3)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 uppercase tracking-wide">
                                Dibatalkan
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-gray-200">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Donasi</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">Anda belum melakukan donasi apapun. Mari mulai berbagi kebaikan hari ini.</p>
            <a href="{{ url('/') }}#campaign" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-primary-600 text-white font-bold hover:bg-primary-700 transition-colors shadow-lg hover:-translate-y-1 transform duration-300">
                Mulai Berdonasi
            </a>
        </div>
    @endif
</div>
@endsection
