<div class="flex flex-col h-full bg-white text-gray-800">
    <!-- Logo -->
    <div class="h-16 flex items-center justify-center border-b border-gray-100 px-6">
        <a href="/" class="flex items-center gap-2">
            <!-- Ensure logo path is correct or use text fallback -->
            <!-- <img src="/assets/images/logo/wecare.png" alt="Logo" class="h-10"> -->
             <span class="text-xl font-bold text-teal-600">PeduliSesama</span>
        </a>
    </div>

    <!-- Menu -->
    <div class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        
        <!-- Dashboard -->
        <a href="/admin" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fa-solid fa-grid-2"></i> <!-- Using FontAwesome if available, or simple SVG -->
            <!-- Using simple SVGs for reliability if FA not loaded globally yet, but preserving user intent if they used FA. The previous file used 'bi' (Bootstrap Icons). I'll switch to simple FA classes or SVGs later if needed, but for now I will assume FA is loaded or I should inject it. Actually master doesn't strictly load FA constantly, Admin home does. I'll rely on text or simple standard icons for now or stick to the BI classes if I include the BI CDN. Let's use BI classes since they are in the content already, I'll add the CDN to master or assume it works. Wait, I removed the bootstrap CSS which might include icons. I should add a CDN for Bootstrap Icons or FontAwesome. I'll add FontAwesome CDN to the sidebar or master. I'll simply use the classes provided. -->
            <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Donatur -->
        <a href="/admin/donatur" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/donatur') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <span class="font-medium">Donatur</span>
        </a>

        <!-- Pegawai -->
        <a href="/admin/pegawai" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/pegawai') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
             <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">Pegawai</span>
        </a>

        <!-- Penggalang Dana (Dropdown) -->
        <div x-data="{ open: {{ request()->is('admin/penggalang-dana*') ? 'true' : 'false' }} }" class="space-y-1">
            <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/penggalang-dana*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    <span class="font-medium">Penggalang Dana</span>
                </div>
                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div x-show="open" x-collapse class="pl-11 pr-3 space-y-1">
                <a href="/admin/penggalang-dana/penggalang-dana" class="block px-3 py-2 rounded-md text-sm {{ request()->is('admin/penggalang-dana/penggalang-dana') ? 'text-teal-600 bg-teal-50/50 font-medium' : 'text-gray-500 hover:text-gray-800' }}">Data Penggalang</a>
                <a href="/admin/penggalang-dana/verifikasi-akun" class="block px-3 py-2 rounded-md text-sm {{ request()->is('admin/penggalang-dana/verifikasi-akun') ? 'text-teal-600 bg-teal-50/50 font-medium' : 'text-gray-500 hover:text-gray-800' }}">Verifikasi Akun</a>
            </div>
        </div>

        <!-- Campaign (Dropdown) -->
        <div x-data="{ open: {{ request()->is('admin/campaign*') ? 'true' : 'false' }} }" class="space-y-1">
             <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/campaign*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <span class="font-medium">Campaign</span>
                </div>
                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div x-show="open" x-collapse class="pl-11 pr-3 space-y-1">
                <a href="/admin/campaign/campaign" class="block px-3 py-2 rounded-md text-sm {{ request()->is('admin/campaign/campaign') ? 'text-teal-600 bg-teal-50/50 font-medium' : 'text-gray-500 hover:text-gray-800' }}">Data Campaign</a>
                <a href="/admin/campaign/berita" class="block px-3 py-2 rounded-md text-sm {{ request()->is('admin/campaign/berita') ? 'text-teal-600 bg-teal-50/50 font-medium' : 'text-gray-500 hover:text-gray-800' }}">Berita</a>
                <a href="/admin/campaign/kategori" class="block px-3 py-2 rounded-md text-sm {{ request()->is('admin/campaign/kategori') ? 'text-teal-600 bg-teal-50/50 font-medium' : 'text-gray-500 hover:text-gray-800' }}">Kategori</a>
            </div>
        </div>

        <!-- Transaksi Donasi -->
        <a href="/admin/transaksi-donasi" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/transaksi-donasi') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            <span class="font-medium">Transaksi Donasi</span>
        </a>

        <!-- Artikel Blog -->
        <a href="/admin/artikel-blog" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/artikel-blog') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            <span class="font-medium">Artikel Blog</span>
        </a>

    </div>
</div>
