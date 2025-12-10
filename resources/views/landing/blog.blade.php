@extends('landing.master')

@section('content')
    @php
        // Get the latest blog for the hero section
        $featured = $blog->first();
        // Get the rest for the grid
        $articles = $blog->skip(1);
        
        $categories = ['Kesehatan', 'Pendidikan', 'Sosial'];
        $colors = [
            'Kesehatan' => 'bg-teal-100 text-teal-700',
            'Pendidikan' => 'bg-blue-100 text-blue-700',
            'Sosial' => 'bg-orange-100 text-orange-700'
        ];
    @endphp

    <!-- Hero Section (Featured Story) -->
    @if($featured)
    <div class="relative w-full h-[500px] rounded-3xl overflow-hidden mb-12 group">
        <div class="absolute inset-0">
            <img src="{{ asset('/storage/images/thumbnail/' . $featured->gambar_blog) }}" alt="{{ $featured->judul_blog }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent opacity-90"></div>
        </div>
        
        <div class="absolute bottom-0 left-0 w-full p-8 md:p-12">
            <div class="max-w-3xl">
                <span class="inline-block px-4 py-1.5 rounded-full bg-primary-600 text-white text-sm font-semibold mb-4 shadow-sm">
                    Kisah Utama
                </span>
                <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 leading-tight">
                    {{ $featured->judul_blog }}
                </h1>
                <p class="text-gray-200 text-lg mb-8 line-clamp-2 max-w-2xl">
                    {{ strip_tags($featured->isi_blog) }}
                </p>
                <a href="{{ url('/blog/'.$featured->slug_blog) }}" class="inline-flex items-center gap-2 bg-white text-gray-900 px-8 py-3.5 rounded-xl font-bold hover:bg-primary-50 transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
                    Baca Selengkapnya
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Sticky Search & Filter Bar -->
    <div class="sticky top-20 z-30 bg-white/80 backdrop-blur-md border border-gray-100 rounded-2xl shadow-sm p-4 mb-10 transition-all duration-300">
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center">
            <!-- Search -->
            <div class="relative w-full md:w-96">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" placeholder="Cari artikel inspiratif..." class="w-full py-2.5 pl-10 pr-4 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary-100 focus:bg-white transition-all text-sm">
            </div>

            <!-- Categories -->
            <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0 w-full md:w-auto no-scrollbar">
                <button class="px-5 py-2 rounded-full bg-primary-600 text-white text-sm font-medium shadow-md transition-all whitespace-nowrap">
                    Semua
                </button>
                <button class="px-5 py-2 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:border-primary-200 hover:text-primary-600 transition-all whitespace-nowrap">
                    Kesehatan
                </button>
                <button class="px-5 py-2 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:border-primary-200 hover:text-primary-600 transition-all whitespace-nowrap">
                    Pendidikan
                </button>
                <button class="px-5 py-2 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:border-primary-200 hover:text-primary-600 transition-all whitespace-nowrap">
                    Sosial
                </button>
            </div>
        </div>
    </div>

    <!-- Article Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        @foreach($articles as $index => $item)
            @php
                $catIndex = rand(0, 2);
                $category = $categories[$catIndex];
                $catColor = $colors[$category];
                $readTime = ceil(str_word_count(strip_tags($item->isi_blog)) / 200);
            @endphp

            <!-- Article Card -->
            <article class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group h-full flex flex-col">
                <div class="h-56 bg-gray-200 overflow-hidden relative">
                    <img src="{{ asset('/storage/images/thumbnail/' . $item->gambar_blog) }}" alt="{{ $item->judul_blog }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide {{ $catColor }} backdrop-blur-sm bg-opacity-90">
                            {{ $category }}
                        </span>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-3 text-xs text-gray-400 mb-3">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ \Carbon\Carbon::parse($item->tgl_terbit_blog)->format('d M Y') }}
                        </span>
                        <span>&bull;</span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $readTime }} Menit baca
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors">
                        <a href="{{ url('/blog/'.$item->slug_blog) }}">
                            {{ $item->judul_blog }}
                        </a>
                    </h3>
                    
                    <p class="text-gray-500 text-sm mb-6 line-clamp-2 flex-1">
                        {{ strip_tags($item->isi_blog) }}
                    </p>
                    
                    <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($item->user->name) }}&background=random" alt="Author" class="w-8 h-8 rounded-full">
                            <span class="text-xs font-medium text-gray-600">{{ $item->user->name }}</span>
                        </div>
                        <a href="{{ url('/blog/'.$item->slug_blog) }}" class="text-primary-600 hover:text-primary-700 font-semibold text-sm flex items-center gap-1">
                            Baca
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Call to Donation (Insert after 3rd item) -->
            @if($index == 2)
            <div class="col-span-1 md:col-span-2 lg:col-span-3 my-8">
                <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-2xl p-8 md:p-12 text-center text-white relative overflow-hidden shadow-xl">
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-10 blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 rounded-full bg-white opacity-10 blur-3xl"></div>
                    
                    <div class="relative z-10 max-w-2xl mx-auto">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4">Terinspirasi dengan kisah mereka?</h3>
                        <p class="text-primary-100 mb-8 text-lg">Ribuan orang menunggu uluran tangan Anda. Mari buat perubahan nyata hari ini bersama PeduliSesama.</p>
                        <a href="{{ url('/') }}#campaign" class="inline-block bg-white text-primary-700 font-bold py-3.5 px-10 rounded-xl shadow-lg hover:bg-primary-50 hover:scale-105 transition-all duration-300">
                            Donasi Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-12">
        {{ $blog->links('pagination::tailwind') }}
    </div>
@endsection
