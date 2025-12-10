@extends('landing.master')
@section('content')
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Banner Image -->
                <div class="relative h-64 md:h-96 w-full">
                    <img src="{{ asset('/storage/' . $campaign->foto_campaign) }}" class="w-full h-full object-cover"
                        alt="Banner Campaign">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6 md:p-10 w-full">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-2 leading-tight">{{ $campaign->judul_campaign }}</h2>
                    </div>
                </div>

                <div class="p-6 md:p-10">
                    <!-- Description -->
                    <div class="prose prose-lg max-w-none text-gray-600 mb-8">
                        {!! str_replace('<img', '<img class="w-full rounded-xl my-4"', $campaign->deskripsi_campaign) !!}
                    </div>
                    
                    <hr class="border-gray-100 my-8">
                    
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <div class="text-center md:text-left">
                            <p class="text-sm text-gray-500 mb-1">Dana Terkumpul</p>
                            <p class="text-2xl font-bold text-primary-600">
                                Rp{{ number_format($campaign->dana_terkumpul, 2, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-center md:text-left">
                            <p class="text-sm text-gray-500 mb-1">Target Dana</p>
                            <p class="text-2xl font-bold text-gray-800">
                                Rp{{ number_format($campaign->target_campaign, 2, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-center md:text-left">
                            <p class="text-sm text-gray-500 mb-1">Tanggal Berakhir</p>
                            <p class="text-xl font-semibold text-gray-700">
                                {{ date('d M Y', strtotime($campaign->tgl_akhir_campaign)) }}
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-start mb-10">
                         <button data-bs-toggle="modal"
                            @auth data-bs-target="#create" @else data-bs-target="#create" @endif 
                            class="w-full md:w-auto px-8 py-4 rounded-full bg-primary-600 text-white font-bold text-lg hover:bg-primary-700 transition-all shadow-lg shadow-primary-500/30 transform hover:-translate-y-1">
                            Donasi Sekarang
                        </button>
                    </div>

                    <hr class="border-gray-100 my-8">

                    <h6 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="w-1.5 h-8 bg-primary-500 rounded-full mr-3"></span>
                        Berita Campaign
                    </h6>
                    
                    <div class="accordion space-y-3" id="beritaAccordion">
                        <div class="accordion-item border border-gray-200 rounded-xl overflow-hidden bg-white">
                            <h2 class="accordion-header mb-0" id="heading">
                                <button class="accordion-button collapsed relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left bg-white border-0 rounded-none transition focus:outline-none" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse" aria-expanded="false" aria-controls="collapse">
                                    Informasi terbaru mengenai campaign akan diupdate di sini.
                                </button>
                            </h2>
                            @foreach ($berita as $key => $item)
                                <div id="collapse" class="accordion-collapse collapse" aria-labelledby="heading"
                                    data-bs-parent="#beritaAccordion">
                                    <div class="accordion-body py-4 px-5 bg-gray-50 border-t border-gray-100">
                                        <a class="block group"
                                            href="{{ $campaign->slug_campaign }}/berita/{{ $item->slug_berita }}">
                                            <p class="font-bold text-gray-800 group-hover:text-primary-600 transition-colors mb-1">{{ $item->judul_berita }}</p>
                                            <span class="text-sm text-gray-500">{{ $item->tgl_terbit_berita }}</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <hr class="border-gray-100 my-8">

                    <h6 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="w-1.5 h-8 bg-primary-500 rounded-full mr-3"></span>
                        Doa dari Donatur
                    </h6>
                    
                    <div class="space-y-4">
                        @foreach ($doa as $item)
                            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-bold text-gray-800">{{ $item->nama }}</h4>
                                    <span class="text-sm font-semibold text-primary-600 bg-primary-50 px-3 py-1 rounded-full">Rp{{ number_format($item->nominal_transaksi, 2, ',', '.') }}</span>
                                </div>
                                <p class="text-gray-600 italic">"{{ $item->keterangan }}"</p>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-2xl border-0 shadow-2xl overflow-hidden">
                @auth
                    <div class="modal-header border-b border-gray-100 px-6 py-4 bg-gray-50">
                        <h1 class="modal-title fs-5 font-bold text-gray-800" id="staticBackdropLabel">Detail Donasi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-6 md:p-8">
                        <form id="donation-form" method="post" action="/donasi" class="space-y-5">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                                    
                            <div class="form-group">
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Donatur</label>
                                <div class="flex gap-2">
                                    <div class="relative flex-1">
                                        <input type="text" id="nama" class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-gray-600 focus:ring-0"
                                            value="{{ Auth::user()->name }}" disabled>
                                        <input type="hidden" name="nama" id="nama-hidden" value="{{ Auth::user()->name }}">
                                    </div>
                                    <button class="px-4 py-2 text-sm font-medium text-primary-600 bg-white border border-primary-200 rounded-xl hover:bg-primary-50 transition-colors"
                                        onclick="toggleForm()" type="button">Ganti</button>
                                </div>
                                <script>
                                    function toggleForm() {
                                        var namaInput = document.getElementById("nama");
                                        var namaHidden = document.getElementById("nama-hidden");
                                        var anonimButton = document.querySelector("button[onclick='toggleForm()']"); // Select button specifically

                                        if (namaInput.disabled) {
                                            namaInput.disabled = false;
                                            namaInput.value = "{{ __('Anonim') }}";
                                            namaHidden.value = "Anonim"; 
                                            // Make input editable to manual name if needed, or just set to Anonim?
                                            // The original code set value to Anonim and enabled it? 
                                            // Actually original code: namaInput.value = "Anonim", disabled=false.
                                            // Let's stick to simple toggle logic:
                                            // If displaying user name -> Switch to Anonim
                                            // If displaying Anonim -> Switch to User Name
                                            
                                            // Re-reading original logic:
                                            // It enabled the input and set value to Anonim, and allowed editing.
                                            // Let's simplified it: Toggle between User Name and 'Anonim'. 
                                            // If we want to allow custom names, we can leave enabled.
                                            // But standard flow is usually User vs Anon.
                                            
                                            namaInput.value = "Anonim";
                                            namaInput.classList.remove('bg-gray-100');
                                            namaInput.classList.add('bg-white');
                                            
                                            // Trigger input event manually or set hidden directly
                                            namaHidden.value = "Anonim";
                                            
                                            anonimButton.textContent = "Pakai Nama Asli";
                                            anonimButton.classList.add('bg-primary-600', 'text-white');
                                            anonimButton.classList.remove('bg-white', 'text-primary-600');
                                        } else {
                                            namaInput.disabled = true;
                                            namaInput.value = "{{ Auth::user()->name }}";
                                            namaHidden.value = "{{ Auth::user()->name }}";
                                            namaInput.classList.add('bg-gray-100');
                                            namaInput.classList.remove('bg-white');
                                            
                                            anonimButton.textContent = "Kirim Sebagai Anonim";
                                            anonimButton.classList.remove('bg-primary-600', 'text-white');
                                            anonimButton.classList.add('bg-white', 'text-primary-600');
                                        }
                                    }
                                </script>
                            </div>
                            
                            <div class="form-group">
                                <label for="nominal" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Donasi</label>
                                <div class="relative">
                                    <input type="text" onkeyup="addCurrency(this)" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all text-lg font-bold text-gray-800" id="nominal" name="nominal" placeholder="Rp0" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="pesan" class="block text-sm font-medium text-gray-700 mb-1">Pesan / Do'a</label>
                                <textarea name="pesan" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all h-32" required placeholder="Tuliskan doa atau dukungan Anda..."></textarea>
                            </div>
                            
                            <div class="pt-4">
                                <button type="submit" class="w-full py-4 rounded-full bg-primary-600 text-white font-bold text-lg hover:bg-primary-700 transition-colors shadow-lg shadow-primary-500/30">Bayar Donasi</button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="modal-content rounded-2xl border-0 shadow-2xl overflow-hidden">
                        <div class="modal-header border-b border-gray-100 px-6 py-4">
                            <h1 class="modal-title font-bold text-lg text-gray-800" id="staticBackdropLabel">Anda perlu login</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-6 py-8 text-center">
                            <p class="text-gray-600 mb-6">Silahkan login terlebih dahulu untuk melanjutkan donasi.</p>
                            <a class="inline-block px-8 py-3 rounded-full bg-primary-600 text-white font-bold hover:bg-primary-700 transition-colors shadow-lg shadow-primary-500/30"
                                href="/login">Login Sekarang</a>
                        </div>
                    </div> 
                @endauth
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function addCurrency(element) {
            // Ambil nilai input
            let value = element.value;

            // Hapus karakter selain angka
            value = value.replace(/[^\d]/g, '');

            // Tambahkan "Rp." di depan nilai
            // Handle if empty
            if (value === "") {
                element.value = "";
                return;
            }

            value = "Rp" + value;

            // Assign nilai yang sudah diubah kembali ke input
            element.value = value;
        }
    </script>
@endsection
