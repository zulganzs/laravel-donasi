@extends('layouts.master')

@section('content')
<div class="mb-5">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Tambah Campaign</h3>
            <p class="text-gray-500 mt-1">Buat campaign donasi baru.</p>
        </div>
    </div>
</div>

<section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6" x-data="{
    target: '',
    formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value).replace('Rp', '').trim();
    },
    updateTarget(e) {
        let val = e.target.value.replace(/[^0-9]/g, '');
        this.target = val;
        e.target.value = this.formatRupiah(val);
    },
    previewImage(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('image-preview-container').classList.remove('hidden');
                document.getElementById('upload-placeholder').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
}">
    <form action="{{ route('admin.campaign.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Judul Campaign -->
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Campaign</label>
                <input type="text" name="judul_campaign" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all" placeholder="Contoh: Bantu Pembangunan Masjid" required>
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="category_id" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Target Dana -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Target Dana (Rp)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-semibold">Rp</span>
                    <input type="text" @input="updateTarget" class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all font-semibold text-gray-700" placeholder="0" required>
                    <!-- Hidden input to send actual number -->
                    <input type="hidden" name="target_campaign" :value="target">
                </div>
            </div>

            <!-- Tanggal Berakhir -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berakhir</label>
                <input type="date" name="tgl_akhir_campaign" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all" min="{{ date('Y-m-d') }}" required>
            </div>

            <!-- Foto Campaign -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Campaign</label>
                <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all overflow-hidden relative">
                    <div id="upload-placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span></p>
                        <p class="text-xs text-gray-500">PNG, JPG or JPEG (Maks. 2MB)</p>
                    </div>
                    <div id="image-preview-container" class="hidden absolute inset-0 w-full h-full">
                        <img id="image-preview" src="#" alt="Preview" class="w-full h-full object-cover">
                    </div>
                    <input type="file" name="foto_campaign" class="hidden" accept="image/*" @change="previewImage" required>
                </label>
            </div>

            <!-- Deskripsi -->
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lengkap</label>
                <textarea name="deskripsi_campaign" rows="5" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all" placeholder="Ceritakan detail campaign..." required></textarea>
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3">
            <a href="/admin/campaign/campaign" class="px-6 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-semibold hover:bg-gray-50 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-teal-600 text-white font-bold hover:bg-teal-700 transition-colors shadow-lg shadow-teal-500/30">Simpan Campaign</button>
        </div>
    </form>
</section>
@endsection
