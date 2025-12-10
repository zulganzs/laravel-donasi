@extends('layouts.master')

@section('content')
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-gray-800">Dashboard</h3>
        <p class="text-gray-500 mt-1">Selamat Datang, <span class="font-semibold text-primary-600">{{ Auth::user()->name }}</span>!</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- User Stats -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Pengguna</p>
                <h4 class="text-2xl font-bold text-gray-800">{{ $jumlahuser }}</h4>
            </div>
        </div>

        <!-- Campaign Stats -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Campaign</p>
                <h4 class="text-2xl font-bold text-gray-800">{{ $jumlahcampaign }}</h4>
            </div>
        </div>

        <!-- Donation Stats -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Dana Terkumpul</p>
                <h4 class="text-2xl font-bold text-gray-800">Rp {{ number_format($jumlahdanaterkumpul, 2, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Top Donors by Amount -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <h4 class="font-bold text-gray-800">5 Donatur Nominal Tertinggi</h4>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-gray-900 font-semibold uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Nama Donatur</th>
                            <th class="px-6 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php $i = 0 @endphp
                        @foreach ($nominalterbanyak as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            @php $i++ @endphp
                            <td class="px-6 py-3 font-medium">{{ $i }}</td>
                            <td class="px-6 py-3 font-bold text-gray-800">{{ $item->user->name }}</td>
                            <td class="px-6 py-3 text-primary-600 font-semibold">Rp {{ number_format($item->max, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Donors by Frequency -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <h4 class="font-bold text-gray-800">5 Donatur Teraktif</h4>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-gray-900 font-semibold uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Nama Donatur</th>
                            <th class="px-6 py-3">Jumlah Donasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php $i = 0 @endphp
                        @foreach ($donasiterbanyak as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            @php $i++ @endphp
                            <td class="px-6 py-3 font-medium">{{ $i }}</td>
                            <td class="px-6 py-3 font-bold text-gray-800">{{ $item->user->name }}</td>
                            <td class="px-6 py-3 text-blue-600 font-semibold">{{ $item->total }} Kali</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
