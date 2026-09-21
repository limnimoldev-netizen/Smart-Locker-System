<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Smart Locker System')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom scrollbar for sidebar */
        #sidebar::-webkit-scrollbar {
            width: 6px;
        }
        #sidebar::-webkit-scrollbar-track {
            background: #1E3A8A;
        }
        #sidebar::-webkit-scrollbar-thumb {
            background: #2d4aa0;
            border-radius: 3px;
        }
        #sidebar::-webkit-scrollbar-thumb:hover {
            background: #3d5ab0;
        }
        /* Smooth transitions for sidebar */
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }
        /* Prevent body scroll when sidebar is open on mobile */
        body.sidebar-open {
            overflow: hidden;
        }
        /* Status badge styles */
        .status-available {
            background-color: #DCFCE7;
            color: #16A34A;
        }
        .status-in-use {
            background-color: #FEE2E2;
            color: #DC2626;
        }
        .status-maintenance {
            background-color: #FFEDD5;
            color: #EA580C;
        }
    </style>
</head>
<body class="bg-[#F5F6FA] text-[#111827] font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Mobile Header -->
            <header class="lg:hidden bg-[#1E3A8A] text-white p-4 flex items-center justify-between">
                <button id="sidebar-toggle" type="button" class="rounded p-2 hover:bg-[#2d4aa0]" aria-label="Open navigation" aria-expanded="false">
                    <i class="fa-solid fa-bars w-6 h-6" aria-hidden="true"></i>
                </button>
                <h1 class="text-lg font-semibold">Smart Locker System</h1>
                <div class="w-10"></div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarClose = document.getElementById('sidebar-close');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        const closeSidebar = () => {
            sidebar?.classList.add('-translate-x-full');
            sidebarOverlay?.classList.add('hidden');
            sidebarToggle?.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('sidebar-open');
        };

        const openSidebar = () => {
            sidebar?.classList.remove('-translate-x-full');
            sidebarOverlay?.classList.remove('hidden');
            sidebarToggle?.setAttribute('aria-expanded', 'true');
            document.body.classList.add('sidebar-open');
        };

        sidebarToggle?.addEventListener('click', openSidebar);
        sidebarClose?.addEventListener('click', closeSidebar);
        sidebarOverlay?.addEventListener('click', closeSidebar);
    </script>

    @stack('scripts')
</body>
</html>
