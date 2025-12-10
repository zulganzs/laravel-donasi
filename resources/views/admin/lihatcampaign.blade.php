@extends('layouts.master')

@section('content')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Detail Campaign</h3>
            <p class="text-gray-500 mt-1">Informasi lengkap mengenai campaign donasi.</p>
        </div>
        <a href="/admin/campaign/campaign" class="flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-semibold hover:bg-gray-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <section>
        @foreach ($campaign as $item)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Image and Key Info -->
                <div class="col-span-1 space-y-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                        <div class="rounded-xl overflow-hidden aspect-video w-full mb-4">
                            <img src="/storage/{{ $item->foto_campaign }}" class="w-full h-full object-cover" alt="{{ $item->judul_campaign }}">
                        </div>
                        <h4 class="font-bold text-gray-800 text-lg mb-2">{{ $item->judul_campaign }}</h4>
                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span>{{ $item->user->name }}</span>
                        </div>
                        <div class="space-y-3 pt-4 border-t border-gray-100">
                             <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Mulai</span>
                                <span class="font-medium text-gray-800">{{ $item->tgl_mulai_campaign }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Selesai</span>
                                <span class="font-medium text-gray-800">{{ $item->tgl_akhir_campaign }}</span>
                            </div>
                             <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Target</span>
                                <span class="font-bold text-primary-600">Rp{{ number_format($item->target_campaign, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Description -->
                <div class="col-span-1 lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 h-full">
                        <h5 class="font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100">Deskripsi Campaign</h5>
                        <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed">
                            {!! str_replace('<img', '<img class="rounded-xl w-full my-4"', $item->deskripsi_campaign) !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection
@section('script')
@endsection

