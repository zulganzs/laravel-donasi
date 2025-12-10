@extends('landing.master')

@section('content')
    @foreach ($berita as $item)
        <!-- Page Header-->
        <header class="relative w-full h-[400px] bg-cover bg-center" style="background-image: url('{{ asset('/storage/images/berita/' . $item->gambar_berita) }}')">
            <div class="absolute inset-0 bg-black/60"></div>
            <div class="relative container mx-auto px-4 h-full flex items-center justify-center text-center">
                <div class="max-w-4xl">
                    <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 leading-tight">{{ $item->judul_berita }}</h1>
                    <div class="flex flex-col md:flex-row justify-center items-center gap-2 md:gap-6 text-gray-200 text-sm font-medium">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Diterbitkan oleh {{ $item->user->name }}
                        </span>
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ date('d M Y', strtotime($item->tgl_terbit_berita)) }}
                        </span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Post Content-->
        <article class="py-12 bg-white min-h-screen">
            <div class="container mx-auto px-4 max-w-4xl">
                <div class="bg-white rounded-3xl p-6 md:p-10 shadow-sm border border-gray-100">
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed space-y-4">
                        {!! $item->isi_berita !!}
                    </div>
                </div>
            </div>
        </article>
    @endforeach
@endsection