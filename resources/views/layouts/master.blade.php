<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - PeduliSesama Admin</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @yield('stylefirst')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('style')
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased" x-data="{ sidebarOpen: true }">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 transition-transform duration-300 transform bg-white border-r border-gray-200 md:relative md:translate-x-0">
             @include('layouts.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden relative w-full transition-all duration-300">
            
            <!-- Navbar -->
            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-4 sm:px-6 z-20 sticky top-0">
                @include('layouts.navbar')
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-8 scroll-smooth bg-gray-50">
                @yield('content')
                
                <footer class="mt-8 text-center text-xs text-gray-500 py-4">
                    <p>&copy; {{ date('Y') }} PeduliSesama. All rights reserved.</p>
                </footer>
            </main>

            <!-- Overlay for mobile sidebar -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 bg-black/50 z-20 md:hidden" style="display: none;"></div>
        </div>
    </div>
    
    @yield('script')
</body>
</html>
