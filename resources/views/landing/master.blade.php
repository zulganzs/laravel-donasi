<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Care</title>
    <link rel="shortcut icon" href="/assets/images/logo/favicon.ico" type="image/x-icon">
    @yield('style')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="font-sans bg-gray-50 text-gray-800 antialiased min-h-screen flex flex-col" id="body">
    <section class="shadow-sm sticky top-0 z-50 bg-primary-600" id="searchbar">
        <!-- Mobile Navbar -->
        <nav class="p-3 md:hidden bg-primary-600 text-white">
            <div class="container mx-auto flex justify-between items-center">
                <a href="/" class="block w-10">
                    <img class="w-full h-auto" src="/assets/images/logo/logo.png" alt="Logo">
                </a>
                <form class="flex-grow ml-4 relative" role="search">
                    <div class="relative w-full">
                        <input type="text" placeholder="Pencarian" name="cari" class="w-full pl-4 pr-10 py-2 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary-300" aria-label="Search"
                            id="searchbox">
                        <svg class="absolute right-3 top-2.5 w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 1920 1920"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </div>
                </form>
            </div>
        </nav>

        <!-- Desktop Navbar -->
        <nav class="hidden md:block bg-primary-600 text-white">
            <div class="container mx-auto py-2 px-4 flex items-center justify-between">
                <a href="/" class="block w-10 mr-8">
                    <img class="w-full h-auto" src="/assets/images/logo/logo.png" alt="Logo">
                </a>
                
                <div class="flex items-center space-x-6">
                    @auth
                        @if (Auth::user()->role == 0)
                            <a href="/admin" class="hover:text-primary-200 transition">Dashboard</a>
                            <div class="relative group">
                                <button class="flex items-center space-x-1 focus:outline-none">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block text-gray-800 z-50">
                                    <a href="/admin/profil" class="block px-4 py-2 hover:bg-gray-100">Profil Saya</a>
                                    <hr class="border-gray-100">
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="/donasi-saya" class="hover:text-primary-200 transition">Donasi Saya</a>
                            <a href="/campaign-saya" class="hover:text-primary-200 transition">Campaign Saya</a>
                            <div class="relative group">
                                <button class="flex items-center space-x-1 focus:outline-none">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block text-gray-800 z-50">
                                    <a href="/profil" class="block px-4 py-2 hover:bg-gray-100">Profil Saya</a>
                                    <hr class="border-gray-100">
                                    <a href="/verifikasi-akun/{{ Auth::user()->id }}" class="block px-4 py-2 hover:bg-gray-100">Verifikasi Akun</a>
                                    <hr class="border-gray-100">
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @else
                        <a href="/#campaign" class="hover:text-primary-200 transition">Campaign</a>
                        <a href="/blog" class="hover:text-primary-200 transition">Blog</a>
                        <a href="/login" class="hover:text-primary-200 transition">Login</a>
                    @endauth
                </div>

                <form class="ml-auto w-64 relative" role="search">
                    <div class="relative">
                        <input type="text" placeholder="Pencarian" name="cari" class="w-full pl-4 pr-10 py-1.5 rounded-full border-none focus:ring-2 focus:ring-primary-300 text-gray-800"
                            aria-label="Search" id="searchbox2">
                        <svg class="absolute right-3 top-2 w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 1920 1920"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </div>
                </form>
            </div>
        </nav>
    </section>

    <!-- Bottom Nav (Mobile Only) -->
    <nav class="fixed bottom-4 left-0 right-0 z-50 md:hidden px-4">
        <div class="container mx-auto max-w-sm">
            <div class="flex items-center justify-around bg-gradient-to-br from-primary-600 to-primary-500 rounded-full shadow-xl border-4 border-white h-16 px-6">
                <a href="/" class="p-1"><img src="/assets/img/home-icon-pink.png" alt="Home" class="h-8"></a>
                <a @auth href="/donasi-saya" @else data-bs-toggle="modal" data-bs-target="#profile" @endauth class="p-1"><img src="/assets/img/donation.png" alt="Donation" class="h-8"></a>
                <a @auth href="/campaign-saya" @else data-bs-toggle="modal" data-bs-target="#profile" @endauth class="p-1"><img src="/assets/img/campaign.png" alt="Campaign" class="h-8"></a>
                <a data-bs-toggle="modal" @auth data-bs-target="#profile" @else data-bs-target="#profile" @endauth class="p-1"><img src="/assets/img/ava-icon-white.png" alt="Profile" class="h-8"></a>
            </div>
        </div>
    </nav>

    <!-- Category / Search Results Overlay -->
    <div id="category" class="hidden bg-white min-h-screen pb-20">
        <div class="container mx-auto px-4 text-center">
            <h5 class="py-4 mt-2 font-bold text-primary-600 text-xl">Hasil Pencarian</h5>
            <button class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-full transition" id="back">
                <svg class="w-4 h-4 mr-2 text-white" fill="currentColor" viewBox="0 0 1024 1024">
                    <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path>
                </svg>
                <span>Kembali</span>
            </button>
            <div class="flex flex-wrap justify-center p-4 gap-4" id="hasil-search">
                <div id="result"></div>
            </div>
        </div>
    </div>


    <!-- Modal Profile -->
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="profile" tabindex="-1" aria-labelledby="profile" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
             <!-- Tailwind Modal Implementation requires JS logic, but since we are keeping bootstrap.js for now (as per script includes), we might need to keep bootstrap classes for modal OR refactor completely to Alpine/Custom JS. 
             Since the prompt asks to "Replace old CSS", but "Preserve logic", and modals are often tied to JS libs. 
             However, the file includes <script src="{{ asset('js/bootstrap.js') }}"></script>.
             If I remove bootstrap.css, this modal might break visually.
             Safe bet: styled manually with Tailwind but keeping generic structure. -->
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                @auth
                    @if (Auth::user()->role == 0)
                        <div class="p-4">
                            <a class="block w-full py-2 px-4 hover:bg-gray-100 rounded text-gray-800" href="/admin/profil"> Profil Saya</a>
                            <hr class="my-2 border-gray-100">
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="block w-full text-left py-2 px-4 hover:bg-gray-100 rounded text-gray-800">Logout</button>
                            </form>
                        </div>
                    @else
                        <div class="p-4">
                            <a class="block w-full py-2 px-4 hover:bg-gray-100 rounded text-gray-800" href="/profil"> Profil Saya</a>
                            <hr class="my-2 border-gray-100">
                            <a class="block w-full py-2 px-4 hover:bg-gray-100 rounded text-gray-800" href="/verifikasi-akun/{{ Auth::user()->id }}">Verifikasi Akun</a>
                            <hr class="my-2 border-gray-100">
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="block w-full text-left py-2 px-4 hover:bg-gray-100 rounded text-gray-800">Logout</button>
                            </form>
                        </div>
                    @endif
                @else
                    <div class="p-4 border-b border-gray-100 text-center">
                        <h3 class="text-xl font-bold text-gray-800 m-0">
                            Anda Perlu Login
                        </h3>
                    </div>
                    <div class="p-4 text-center">
                        <a class="inline-block px-6 py-2 bg-primary-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg transition duration-150 ease-in-out"
                            href="/login">Login</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <div class="flex-grow">
        @yield('content')
    </div>

    <footer class="py-6 bg-white border-t border-gray-100">
       <div class="container mx-auto px-4 text-center text-gray-500 text-sm">
           &copy; {{ date('Y') }} We Care. All rights reserved.
       </div>
    </footer>

    <script src="{{ asset('js/splide.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <script>
        const search = document.getElementById('searchbox');
        const search2 = document.getElementById('searchbox2');
        const searchResults = document.getElementById('hasil-search');
        const resultSpace = document.getElementById('result');
        const categoryspace = document.getElementById('category');
        const body = document.getElementById('body');
        const items = body.querySelectorAll('.item');
        const campaigns = body.querySelectorAll('.campaign');

        function updateSearchResults(data) {
            let html = '';

            if (data.length > 0) {
                resultSpace.classList.add('hidden'); // Tailwind hidden
                categoryspace.classList.remove("hidden");
                campaigns.forEach(function(campaign) {
                    campaign.style.display = 'none';
                });

                items.forEach(function(item) {
                    item.style.display = 'none';
                });

                data.forEach(result => {
                    // Refactored HTML to use Tailwind
                    html += `
                        <a href="campaign/${result.slug_campaign}" class="item group block bg-white rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden w-72 m-2 no-underline text-gray-800 border border-gray-100" data-filter="${result.category_id}">
                            <div class="relative h-64 overflow-hidden">
                                <img src="/storage/${result.foto_campaign}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="${result.judul_campaign}">
                            </div>
                            <div class="p-4">
                                <h5 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 min-h-[3.5rem]">${result.judul_campaign}</h5>
                                
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-3">
                                    <div class="bg-primary-600 h-2.5 rounded-full" style="width:${(result.dana_terkumpul/result.target_campaign)*100}%"></div>
                                </div>
                                
                                <p class="text-sm font-semibold text-primary-600 mb-1">Terkumpul: Rp${result.dana_terkumpul.toLocaleString()},00</p>
                                <p class="text-xs text-gray-500">Berakhir: ${result.tgl_akhir_campaign}</p>
                            </div>
                        </a>
                    `;
                });
            } else {
                resultSpace.classList.remove('hidden');
            }

            searchResults.innerHTML = html;
        }

        search.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            fetch('{{ route('cari') }}?filter=' + filter)
                .then(response => response.json())
                .then(data => updateSearchResults(data))
                .catch(error => console.error('Error:', error));
        });


        search2.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            fetch('{{ route('cari') }}?filter=' + filter)
                .then(response => response.json())
                .then(data => updateSearchResults(data))
                .catch(error => console.error('Error:', error));
        });
    </script>

    <script>
        const back = document.getElementById('back');
        back.addEventListener('click', function() {
            resultSpace.classList.remove('hidden'); // Tailwind hidden
            categoryspace.classList.add("hidden");
            campaigns.forEach(function(campaign) {
                campaign.style.display = 'block';
            });

            items.forEach(function(item) {
                item.style.display = 'block';
            });
        });
    </script>


    @yield('script')
</body>

</html>
