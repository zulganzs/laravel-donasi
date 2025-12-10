@extends('layouts.master')

@section('content')
    <div x-data="{ showEditModal: false, selectedId: null, selectedStatus: null }">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Verifikasi Akun</h3>
                <p class="text-gray-500 mt-1">Kelola status verifikasi akun pengguna.</p>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-700 border border-green-100 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('message') }}
            </div>
        @endif
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 border border-red-100 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ search: '' }">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center gap-4 flex-wrap">
                <h4 class="font-bold text-gray-800 text-lg">List Permintaan Verifikasi</h4>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input x-model="search" type="text" placeholder="Cari nama atau KTP..." class="pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-100 focus:border-primary-500 outline-none transition-all w-64 text-sm">
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-gray-900 font-semibold uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Nama User</th>
                            <th class="px-6 py-4">Nomor KTP</th>
                            <th class="px-6 py-4">Nama Sesuai KTP</th>
                            <th class="px-6 py-4">Tgl Lahir</th>
                            <th class="px-6 py-4">Alamat</th>
                            <th class="px-6 py-4">Foto KTP</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php $i = 0 @endphp
                        @foreach ($verifikasiakun as $item)
                            @php $i++ @endphp
                            <tr class="hover:bg-gray-50 transition-colors" x-show="$el.textContent.toLowerCase().includes(search.toLowerCase())">
                                <td class="px-6 py-4 font-medium">{{ $i }}</td>
                                <td class="px-6 py-4 font-bold text-gray-800">{{ $item->user->name }}</td>
                                <td class="px-6 py-4">{{ $item->nomor_ktp }}</td>
                                <td class="px-6 py-4">{{ $item->nama_ktp }}</td>
                                <td class="px-6 py-4">{{ $item->tanggal_lahir }}</td>
                                <td class="px-6 py-4 min-w-[200px]">{{ $item->alamat }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ asset('/storage/' . $item->foto_ktp) }}" target="_blank">
                                        <img src="{{ asset('/storage/' . $item->foto_ktp) }}" alt="KTP" class="h-12 w-20 object-cover rounded-lg border border-gray-200 hover:scale-110 transition-transform">
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->status_verifikasi == 0)
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Pending</span>
                                    @elseif ($item->status_verifikasi == 1)
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Disetujui</span>
                                    @elseif ($item->status_verifikasi == 2)
                                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <button @click="selectedId = {{ $item->user_id }}; selectedStatus = {{ $item->status_verifikasi }}; showEditModal = true" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Edit Status Modal -->
        <div x-show="showEditModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="showEditModal = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
                    <form action="/admin/penggalang-dana/edit-status-verifikasi-akun" method="POST" class="p-6">
                        @csrf
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900">Ubah Status Verifikasi</h3>
                            <button type="button" @click="showEditModal = false" class="text-gray-400 hover:text-gray-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <input type="hidden" name="id" :value="selectedId">
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <div class="relative">
                                    <select name="status" x-model="selectedStatus" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-100 focus:border-primary-500 outline-none transition-all appearance-none bg-white">
                                        <option value="0">Pending</option>
                                        <option value="1">Disetujui</option>
                                        <option value="2">Ditolak</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <button type="button" @click="showEditModal = false" class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-semibold hover:bg-gray-50 transition-colors">
                                Batal
                            </button>
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary-600 text-white font-bold hover:bg-primary-700 transition-colors shadow-sm">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
@endsection
