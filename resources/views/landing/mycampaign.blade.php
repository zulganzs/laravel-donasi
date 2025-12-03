@extends('layouts.peduli_layout')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Campaign Saya</h1>
            <p class="text-gray-500 mt-1">Program kebaikan yang Anda inisiasi.</p>
        </div>
        <a href="{{ url('/buat-campaign') }}" class="hidden md:inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary-600 text-white font-bold hover:bg-primary-700 transition-colors shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Campaign Baru
        </a>
    </div>

    @if (count($campaign) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($campaign as $item)
                <a href="{{ url('/campaign/'.$item->slug_campaign) }}" class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group flex flex-col h-full">
                    <!-- Image -->
                    <div class="h-48 bg-gray-200 relative overflow-hidden">
                        <img src="/storage/{{ $item->foto_campaign }}" alt="{{ $item->judul_campaign }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4">
                            @if ($item->status_campaign == 0)
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 uppercase tracking-wide shadow-sm">Pending</span>
                            @elseif ($item->status_campaign == 1)
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 uppercase tracking-wide shadow-sm">Disetujui</span>
                            @elseif ($item->status_campaign == 2)
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 uppercase tracking-wide shadow-sm">Ditolak</span>
                            @elseif ($item->status_campaign == 3)
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 uppercase tracking-wide shadow-sm">Selesai</span>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors">
                            {{ $item->judul_campaign }}
                        </h3>
                        
                        <div class="mt-auto">
                            <!-- Progress Bar -->
                            <div class="mb-4">
                                @php
                                    $persentase = $item->target_campaign > 0 ? ($item->dana_terkumpul / $item->target_campaign) * 100 : 0;
                                @endphp
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="font-semibold text-gray-900">Rp {{ number_format($item->dana_terkumpul, 0, ',', '.') }}</span>
                                    <span class="text-gray-500 text-xs">Target: Rp {{ number_format($item->target_campaign / 1000000, 0) }}jt</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="bg-primary-500 h-2 rounded-full transition-all duration-500" style="width: {{ $persentase }}%"></div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between text-xs text-gray-500 border-t border-gray-50 pt-3">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>Berakhir: {{ date('d M Y', strtotime($item->tgl_akhir_campaign)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-gray-200">
            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 text-blue-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Campaign</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">Anda belum membuat program penggalangan dana. Yuk mulai inisiatif kebaikanmu sekarang.</p>
            <a href="{{ url('/buat-campaign') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-primary-600 text-white font-bold hover:bg-primary-700 transition-colors shadow-lg hover:-translate-y-1 transform duration-300">
                Buat Campaign
            </a>
        </div>
    @endif
</div>
@endsection
