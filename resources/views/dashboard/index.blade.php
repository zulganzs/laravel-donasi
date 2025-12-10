@extends('layouts.peduli_layout')

@section('content')
    <!-- Hero Section & Welcome -->
    <div class="mb-10">
        <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-3xl p-8 md:p-12 text-white shadow-lg relative overflow-hidden">
            <!-- Decorative Circles -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-10 blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 rounded-full bg-white opacity-10 blur-2xl"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-8">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">Halo, {{ $user ? $user->name : 'Orang Baik' }}! 👋</h1>
                    <p class="text-primary-100 text-lg max-w-xl">Siap berbagi kebaikan hari ini? Setiap rupiah yang Anda donasikan membawa harapan baru bagi mereka yang membutuhkan.</p>
                    
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ url('/') }}#campaign" class="bg-white text-primary-700 font-bold py-3 px-8 rounded-xl shadow-md hover:bg-primary-50 hover:scale-105 transition-all duration-300 transform">
                            Donasi Sekarang
                        </a>
                        <a href="{{ url('/') }}#campaign" class="bg-transparent border-2 border-primary-200 text-white font-semibold py-3 px-8 rounded-xl hover:bg-white/10 transition-all duration-300">
                            Lihat Program
                        </a>
                    </div>
                </div>

                <!-- Trust Indicators (Global Stats) -->
                <div class="flex gap-8 md:gap-12 text-center">
                    <div>
                        <p class="text-3xl md:text-4xl font-bold mb-1">Rp {{ number_format($total_dana / 1000000, 1) }}M+</p>
                        <p class="text-primary-200 text-sm font-medium uppercase tracking-wider">Dana Terkumpul</p>
                    </div>
                    <div>
                        <p class="text-3xl md:text-4xl font-bold mb-1">{{ number_format($total_penerima) }}+</p>
                        <p class="text-primary-200 text-sm font-medium uppercase tracking-wider">Penerima Manfaat</p>
                    </div>
                    <div>
                        <p class="text-3xl md:text-4xl font-bold mb-1">{{ $program_aktif }}</p>
                        <p class="text-primary-200 text-sm font-medium uppercase tracking-wider">Program Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Row (User Personal Stats) -->
    <!-- Quick Stats Row (User Personal Stats) -->
    @auth
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 rounded-full bg-primary-50 flex items-center justify-center text-primary-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Donasi Anda</p>
                <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($user_donation_total, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Kampanye Diikuti</p>
                <p class="text-2xl font-bold text-gray-800">{{ $user_campaign_count }} Program</p>
            </div>
        </div>
    </div>
    @endauth

    <!-- Featured Categories -->
    <div class="mb-10">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Program Pilihan</h2>
            <a href="{{ url('/') }}#campaign" class="text-primary-600 font-medium hover:text-primary-700 hover:underline">Lihat Semua</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featured_campaigns as $campaign)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:scale-105 transition-all duration-300 group cursor-pointer">
                <div class="h-48 bg-gray-200 relative overflow-hidden">
                    <img src="/images/{{ $campaign->gambar_campaign }}" alt="{{ $campaign->judul_campaign }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur text-xs font-bold px-3 py-1 rounded-full text-teal-700 uppercase tracking-wide">
                        {{ $campaign->kategori_campaign }}
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors">{{ $campaign->judul_campaign }}</h3>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ strip_tags($campaign->deskripsi_campaign) }}</p>
                    
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        @php
                            $terkumpul = $campaign->transaksi->where('status_transaksi', 1)->sum('nominal_transaksi');
                            $persentase = $campaign->target_campaign > 0 ? ($terkumpul / $campaign->target_campaign) * 100 : 0;
                        @endphp
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-semibold text-primary-700">Rp {{ number_format($terkumpul, 0, ',', '.') }}</span>
                            <span class="text-gray-500">dari Rp {{ number_format($campaign->target_campaign / 1000000, 0) }}jt</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5">
                            <div class="bg-primary-500 h-2.5 rounded-full" style="width: {{ $persentase }}%"></div>
                        </div>
                        <div class="text-right mt-1">
                            <span class="text-xs font-bold text-primary-600">{{ number_format($persentase, 0) }}% Terkumpul</span>
                        </div>
                    </div>

                    <a href="{{ url('/campaign/'.$campaign->slug) }}" class="block w-full text-center py-2.5 rounded-xl bg-primary-600 text-white font-semibold hover:bg-primary-700 transition-colors shadow-sm">
                        Donasi Sekarang
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Latest Updates (Blog) -->
    <div class="mb-10">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Kabar Terbaru & Artikel</h2>
            <a href="{{ url('/blog') }}" class="text-primary-600 font-medium hover:text-primary-700 hover:underline">Lihat Blog</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($latest_blogs as $blog)
            <article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all group">
                <div class="h-32 bg-gray-200 overflow-hidden">
                    <img 
                    src="{{ $blog->gambar_blog ? asset('storage/images/thumbnail/' . $blog->gambar_blog) : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=800&q=80' }}" 
                    alt="{{ $blog->judul_blog ?? 'Artikel PeduliSesama' }}" 
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=800&q=80';"
                >
                </div>
                <div class="p-4">
                    <span class="text-xs font-semibold text-primary-600 mb-2 block">Artikel</span>
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors">{{ $blog->judul_blog }}</h3>
                    <p class="text-gray-500 text-xs mb-3 line-clamp-2">{{ strip_tags($blog->isi_blog) }}</p>
                    <a href="{{ url('/blog/'.$blog->slug_blog) }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">Baca Selengkapnya &rarr;</a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
@endsection
