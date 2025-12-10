@extends('landing.master')
@section('style')
    <link rel="stylesheet" href="/css/splide.min.css">
@endsection
@section('content')
    <!-- Hero Section / Welcome -->
    <section id="hero" class="py-12 bg-teal-50">
        <div class="container mx-auto px-4 max-w-6xl">
            <h3 class="text-3xl font-bold text-gray-800 mb-6">Selamat Datang !</h3>
            
            <!-- Hero Card -->
            <a href="#" data-bs-toggle="modal" data-bs-target="#createcampaign" class="block group">
                <div class="relative h-64 md:h-80 rounded-3xl overflow-hidden shadow-lg transform transition-transform duration-300 group-hover:scale-[1.02]">
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url(/public/storage/images/background-donasi.jpeg);"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8 sm:p-12 w-full max-w-3xl">
                        <h1 class="text-white text-3xl md:text-5xl font-bold leading-tight">Galang Dana Sekarang</h1>
                        <p class="text-white/90 mt-2 text-lg">Mulai langkah kebaikanmu hari ini bersama kami.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- modal -->
        <div class="modal fade" id="createcampaign" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                @auth
                    <div class="modal-content rounded-2xl border-0 shadow-2xl overflow-hidden">
                        <div class="modal-header bg-gray-50 border-b border-gray-100 px-6 py-4">
                            <h1 class="modal-title text-lg font-bold text-gray-800" id="staticBackdropLabel">Tatacara Galang Dana</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-6 py-6 text-gray-600 leading-relaxed">
                            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Temporibus, doloremque aut? Neque aliquam eos sed alias quidem sunt sapiente doloremque.</p>
                            <p>Molestiae quasi iusto rerum ut commodi cum ipsam corrupti, illo saepe a nesciunt quod. Beatae dolorem quibusdam voluptates reprehenderit! Est, praesentium!</p>
                        </div>
                        <div class="modal-footer border-t border-gray-100 px-6 py-4 bg-gray-50 flex justify-end gap-2">
                            <button type="button" class="px-5 py-2.5 rounded-full text-gray-600 font-medium hover:bg-gray-200 transition-colors" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="px-5 py-2.5 rounded-full bg-primary-600 text-white font-medium hover:bg-primary-700 transition-colors shadow-lg shadow-primary-500/30" data-bs-toggle="modal" data-bs-target="#create">Selanjutnya</button>
                        </div>
                    </div>
                @else
                    <div class="modal-content rounded-2xl border-0 shadow-2xl overflow-hidden">
                        <div class="modal-header border-b border-gray-100 px-6 py-4">
                            <h1 class="modal-title text-lg font-bold text-gray-800" id="staticBackdropLabel">Anda Perlu Login</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-6 py-8 text-center">
                            <p class="mb-6 text-gray-600">Silahkan login terlebih dahulu untuk membuat campaign.</p>
                            <a class="inline-block px-8 py-3 rounded-full bg-primary-600 text-white font-bold hover:bg-primary-700 transition-colors shadow-lg shadow-primary-500/30" href="/login">Login Sekarang</a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
        
        @auth
            <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    @if (Auth::user()->role == 2)
                        <div class="modal-content rounded-2xl border-0 shadow-2xl">
                            <div class="modal-header bg-gray-50 border-b border-gray-100 px-6 py-4">
                                <h1 class="modal-title text-lg font-bold text-gray-800" id="staticBackdropLabel">Form Galang Dana</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-6 py-6">
                                <form method="post" action="/buat-campaign" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                            <input type="text" class="w-full px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-gray-500" disabled value="{{ Auth::user()->email }}">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penggalang</label>
                                            <input disabled type="text" class="w-full px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-gray-500" value="{{ Auth::user()->name }}">
                                            <input name="user_id" type="hidden" value="{{ Auth::user()->id }}" required>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Campaign</label>
                                        <select name="category_id" class="w-full px-4 py-2 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Campaign</label>
                                        <input name="judul_campaign" type="text" class="w-full px-4 py-2 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all" placeholder="Contoh: Bantuan untuk Korban Banjir" required>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Campaign</label>
                                        <textarea name="deskripsi_campaign" id="editor" class="w-full px-4 py-2 bg-white border border-gray-200 rounded-lg text-gray-700"></textarea>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Target Dana (Rp)</label>
                                        <input name="target_campaign" type="number" class="w-full px-4 py-2 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all" placeholder="0" required>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berakhir</label>
                                        <input name="tgl_akhir" type="date" min="{{ date('Y-m-d') }}" class="w-full px-4 py-2 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all" required>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Banner Campaign</label>
                                        <input class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100" type="file" name="image" id="formFile" required>
                                    </div>
                                    
                                    <div class="pt-4">
                                        <button type="submit" class="w-full py-3 rounded-full bg-primary-600 text-white font-bold hover:bg-primary-700 transition-colors shadow-lg shadow-primary-500/30">Kirim Campaign</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="modal-content rounded-2xl border-0 shadow-2xl">
                            <div class="modal-header border-b border-gray-100 px-6 py-4">
                                <h1 class="modal-title text-lg font-bold text-gray-800" id="staticBackdropLabel">Verifikasi Akun Anda</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-6 py-8 text-center">
                                <p class="mb-6 text-gray-600">Akun Anda belum terverifikasi sebagai penggalang dana. Mohon verifikasi identitas Anda terlebih dahulu.</p>
                                <a class="inline-block px-8 py-3 rounded-full bg-primary-600 text-white font-bold hover:bg-primary-700 transition-colors shadow-lg shadow-primary-500/30" href="/verifikasi-akun/.{{ Auth::user()->id }}">Verifikasi Sekarang</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endauth

    </section>

    <!-- Categories Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 max-w-6xl text-center">
            <h5 class="text-2xl font-bold text-gray-800 mb-8">Kategori Pilihan</h5>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <a href="/kategori/pendidikan" class="group block p-8 rounded-3xl bg-teal-50 hover:bg-teal-100 transition-all duration-300">
                    <img src="assets/img/education.svg" alt="Pendidikan" class="h-24 mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <p class="text-lg font-bold text-primary-800">Pendidikan</p>
                </a>
                
                <a href="/kategori/sosial" class="group block p-8 rounded-3xl bg-teal-50 hover:bg-teal-100 transition-all duration-300">
                    <img src="assets/img/social.svg" alt="Sosial" class="h-24 mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <p class="text-lg font-bold text-primary-800">Sosial</p>
                </a>
                
                <a href="/kategori/kesehatan" class="group block p-8 rounded-3xl bg-teal-50 hover:bg-teal-100 transition-all duration-300">
                    <img src="assets/img/health.svg" alt="Kesehatan" class="h-24 mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <p class="text-lg font-bold text-primary-800">Kesehatan</p>
                </a>
                
            </div>
        </div>
    </section>

    <!-- Urgent Campaigns Carousel -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="flex items-center justify-between mb-8">
                <h5 class="text-2xl font-bold text-gray-800">Penggalangan Dana Mendesak</h5>
            </div>
            
            <div class="splide" aria-label="Campaign Carousel">
                <div class="splide__track py-4">
                    <ul class="splide__list">
                        @foreach ($campaign as $item)
                            <li class="splide__slide px-2">
                                <a href="/campaign/{{ $item->slug_campaign }}" class="block group h-full">
                                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden h-full hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                        <div class="relative h-48 overflow-hidden">
                                            <img src="{{ asset('/storage/' . $item->foto_campaign) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $item->judul_campaign }}">
                                        </div>
                                        <div class="p-5">
                                            <h5 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors">{{ $item->judul_campaign }}</h5>
                                            
                                            <div class="w-full bg-gray-100 rounded-full h-2.5 mb-2">
                                                <div class="bg-primary-500 h-2.5 rounded-full" style="width: {{ ($item->dana_terkumpul / $item->target_campaign) * 100 }}%"></div>
                                            </div>
                                            
                                            <div class="flex justify-between items-end mt-4">
                                                <div>
                                                    <p class="text-xs text-gray-500">Terkumpul</p>
                                                    <p class="text-sm font-bold text-primary-600">Rp{{ number_format($item->dana_terkumpul, 2, ',', '.') }}</p>
                                                </div>
                                                 <div class="text-right">
                                                    <p class="text-xs text-gray-500">Sisa Hari</p>
                                                    <!-- Simple calculation logic or date display -->
                                                    <p class="text-xs font-semibold text-gray-700">{{ \Carbon\Carbon::parse($item->tgl_akhir_campaign)->diffInDays(now()) }} Hari</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Carousel Slider (Success Stories or Highlights) -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 max-w-6xl">
            <div id="carouselExampleCaptions" class="carousel slide rounded-3xl overflow-hidden shadow-lg relative" data-bs-ride="carousel">
                <div class="carousel-indicators absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active w-3 h-3 rounded-full bg-white opacity-50 transition-opacity aria-[current=true]:opacity-100 aria-[current=true]:bg-primary-500 border-0" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class="w-3 h-3 rounded-full bg-white opacity-50 transition-opacity aria-[current=true]:opacity-100 aria-[current=true]:bg-primary-500 border-0" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" class="w-3 h-3 rounded-full bg-white opacity-50 transition-opacity aria-[current=true]:opacity-100 aria-[current=true]:bg-primary-500 border-0" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner relative w-full h-64 md:h-96">
                    <div class="carousel-item active absolute inset-0 transition-transform duration-700 ease-in-out">
                        <img src="https://images.unsplash.com/photo-1581059686229-de26e6ae5dc4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1172&q=80" class="w-full h-full object-cover" alt="...">
                        <div class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-center p-8">
                            <h5 class="text-white text-2xl md:text-3xl font-bold mb-2">Aksi Penyaluran Dana Bantuan Tsunami</h5>
                            <p class="text-white/90 text-sm md:text-base max-w-2xl">Membantu saudara kita yang terdampak bencana alam untuk bangkit kembali.</p>
                        </div>
                    </div>
                    <div class="carousel-item absolute inset-0 transition-transform duration-700 ease-in-out">
                        <img src="https://images.unsplash.com/photo-1475776408506-9a5371e7a068?ixlib=rb-4.0.3&auto=format&fit=crop&w=1058&q=80" class="w-full h-full object-cover" alt="...">
                        <div class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-center p-8">
                            <h5 class="text-white text-2xl md:text-3xl font-bold mb-2">Penyaluran Dana Bantuan Semeru</h5>
                            <p class="text-white/90 text-sm md:text-base max-w-2xl">Distribusi logistik dan bantuan medis untuk korban erupsi.</p>
                        </div>
                    </div>
                    <div class="carousel-item absolute inset-0 transition-transform duration-700 ease-in-out">
                        <img src="https://images.unsplash.com/photo-1544257750-572358f5da22?ixlib=rb-4.0.3&auto=format&fit=crop&w=1215&q=80" class="w-full h-full object-cover" alt="...">
                        <div class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-center p-8">
                            <h5 class="text-white text-2xl md:text-3xl font-bold mb-2">Bantuan Badai Tropis</h5>
                            <p class="text-white/90 text-sm md:text-base max-w-2xl">Membangun kembali atap dan harapan bagi mereka yang kehilangan tempat tinggal.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev absolute top-0 left-0 z-10 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 ring-4 ring-white/10 group-focus:ring-white/50 focus:outline-none">
                        <svg aria-hidden="true" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        <span class="visually-hidden">Previous</span>
                    </span>
                </button>
                <button class="carousel-control-next absolute top-0 right-0 z-10 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 ring-4 ring-white/10 group-focus:ring-white/50 focus:outline-none">
                        <svg aria-hidden="true" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="visually-hidden">Next</span>
                    </span>
                </button>
            </div>
        </div>
    </section>

    <!-- Latest Articles -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 max-w-6xl">
            <h5 class="text-2xl font-bold text-gray-800 mb-8 border-l-4 border-primary-500 pl-4">Artikel Terbaru</h5>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($blog as $item)
                    <div class="flex flex-col bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 group">
                        <div class="h-48 overflow-hidden relative">
                        <img 
                            src="{{ $item->gambar_blog ? asset('/storage/images/thumbnail/' . $item->gambar_blog) : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=800&q=80' }}" 
                            alt="{{ $item->judul_blog }}" 
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=800&q=80';"
                        >
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                            <h5 class="text-xl font-bold mb-3">
                                <a href="/blog/{{ $item->slug_blog }}" class="text-gray-900 hover:text-primary-600 transition-colors line-clamp-2">
                                    {{ $item->judul_blog }}
                                </a>
                            </h5>
                            <div class="text-gray-600 mb-4 line-clamp-3 text-sm leading-relaxed">
                                {!! Str::limit(strip_tags($item->isi_blog), 100) !!}
                            </div>
                            <div class="mt-auto pt-4 border-t border-gray-50 flex items-center text-sm text-gray-400">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ date('d M Y', strtotime($item->updated_at)) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="/blog" class="inline-flex items-center px-6 py-3 rounded-full bg-white border border-primary-200 text-primary-600 font-semibold hover:bg-primary-50 transition-colors">
                    Artikel Lainnya
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/36.0.1/ckeditor.min.js"
        integrity="sha512-m1b22NPZjHOJ4PEMtKYmqK7s9UOKOQ2o7e+tTMfPLqGDN1jXUeE0JHSOVkuF3UIWDk/tLvbhv/Qjgb3c8G1k6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var splide = new Splide('.splide', {
                perPage: 3,
                gap: '1.5rem',
                rewind: true,
                breakpoints: {
                    768: {
                        perPage: 1,
                        gap: '1rem',
                    },
                    1024: {
                        perPage: 2,
                        gap: '1.25rem',
                    }
                }
            });
            splide.mount();
        });
    </script>
    <script>
        //Define an adapter to upload the files
        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
                this.url = '{{ route('upload-gambar-campaign') }}';
            }
            upload() {
                return this.loader.file.then(
                    (file) =>
                    new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    })
                );
            }
            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }
            _initRequest() {
                const xhr = (this.xhr = new XMLHttpRequest());
                xhr.open("POST", this.url, true);
                xhr.setRequestHeader("x-csrf-token", "{{ csrf_token() }}");
                xhr.responseType = "json";
            }
            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${file.name}.`;
                xhr.addEventListener("error", () => reject(genericErrorText));
                xhr.addEventListener("abort", () => reject());
                xhr.addEventListener("load", () => {
                    const response = xhr.response;
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }
                    resolve({
                        default: response.url,
                    });
                });
                if (xhr.upload) {
                    xhr.upload.addEventListener("progress", (evt) => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }
            _sendRequest(file) {
                const data = new FormData();
                data.append("upload", file);
                this.xhr.send(data);
            }
        }

        function SimpleUploadAdapterPlugin(editor) {
            editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor.create(document.querySelector("#editor"), {
            extraPlugins: [SimpleUploadAdapterPlugin],
        }).catch((error) => {
            console.error(error);
        });
    </script>
@endsection
