<div class="flex items-center justify-between w-full">
    <!-- Sidebar Toggle (Mobile) -->
    <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 md:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
    </button>

    <!-- Right Side: User Menu -->
    <div class="flex items-center gap-4 ml-auto">
        
        <div class="flex items-center gap-3">
             <div class="hidden md:block text-right">
                <h6 class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</h6>
                <p class="text-xs text-gray-500">
                    @if (Auth()->user()->level == 0)
                        Admin
                    @endif
                    @if (Auth()->user()->level == 1)
                        Pegawai
                    @endif
                </p>
            </div>
            
            <!-- Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center focus:outline-none">
                     <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold overflow-hidden border border-teal-200">
                        <!-- Use UI Avatars if no image, or just initial -->
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0d9488&color=fff" alt="User" class="w-full h-full object-cover">
                    </div>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" x-transition.origin.top.right class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
                    <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50">
                        <p class="text-sm font-medium text-gray-900">Halo, {{ Auth::user()->name }}</p>
                    </div>
                    
                    <a href="/admin/profil" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-teal-600">
                        <i class="fa-solid fa-user mr-2 text-gray-400"></i> Profil Saya
                    </a>
                    
                    <div class="border-t border-gray-50 my-1"></div>
                    
                    <form action="/logout" method="post" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                            <i class="fa-solid fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
