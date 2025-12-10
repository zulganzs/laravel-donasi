@extends('layouts.master')

@section('content')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Data Transaksi Donasi</h3>
            <p class="text-gray-500 mt-1">Riwayat donasi yang masuk ke sistem.</p>
        </div>
    </div>

    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ search: '' }">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center gap-4 flex-wrap">
            <h4 class="font-bold text-gray-800 text-lg">Riwayat Transaksi</h4>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input x-model="search" type="text" placeholder="Cari transaksi..." class="pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-100 focus:border-primary-500 outline-none transition-all w-64 text-sm">
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-gray-900 font-semibold uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Donatur</th>
                        <th class="px-6 py-4">Campaign</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Nominal</th>
                        <th class="px-6 py-4">Ket</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @php $i = 0 @endphp
                    @foreach ($transaksi as $item)
                        @php $i++ @endphp
                        <tr class="hover:bg-gray-50 transition-colors" x-show="$el.textContent.toLowerCase().includes(search.toLowerCase())">
                            <td class="px-6 py-4 font-medium">{{ $i }}</td>
                            <td class="px-6 py-4 font-bold text-gray-800">{{ $item->user->name }}</td>
                            <td class="px-6 py-4 max-w-xs truncate" title="{{ $item->campaign->judul_campaign }}">{{ $item->campaign->judul_campaign }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->tgl_transaksi }}</td>
                            <td class="px-6 py-4 font-bold text-green-600">Rp{{ number_format($item->nominal_transaksi, 2, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $item->keterangan }}</td>
                            <td class="px-6 py-4">
                                @if ($item->status_transaksi == 0)
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">Pending</span>
                                @elseif ($item->status_transaksi == 1)
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">Sukses</span>
                                @elseif ($item->status_transaksi == 2)
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">Kedaluwarsa/Batal</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection

@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <!-- Alpine JS is already included in master layout, removing generic DataTables scripts -->
@endsection

