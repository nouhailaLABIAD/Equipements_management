<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* Sidebar Styles */
        .sidebar {
            width: 240px;
            background: white;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            border-right: 1px solid #e5e7eb;
            padding-top: 4rem;
            z-index: 20;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: #374151;
            text-decoration: none;
            transition: all 0.2s;
        }

        .sidebar-menu li a:hover {
            background-color: #f3f4f6;
            color: #3b82f6;
        }

        .sidebar-menu li a.active {
            background-color: #eff6ff;
            color: #3b82f6;
            border-left: 3px solid #3b82f6;
        }

        .sidebar-toggle {
            position: absolute;
            right: -40px;
            top: 10px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        /* Content Adjustment */
        .content-with-sidebar {
            margin-left: 240px;
            transition: margin-left 0.3s ease;
        }

        .content-collapsed {
            margin-left: 0;
        }

        /* Header */
        .main-header {
            position: fixed;
            top: 0;
            right: 0;
            left: 240px;
            z-index: 10;
            transition: left 0.3s ease;
        }

        .header-collapsed {
            left: 0;
        }
        /* Ajoutez ceci dans la section <style> */
.main-content {
    padding-top: 4rem; /* Ajustez cette valeur selon la hauteur de votre header */
    min-height: calc(100vh - 6rem); /* S'assure que le contenu prend toute la hauteur */
}
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ sidebarOpen: window.innerWidth > 1024 }">
    <!-- Sidebar -->
    <div class="sidebar" :class="{ 'collapsed': !sidebarOpen }">
    <div class="sidebar-toggle" @click="sidebarOpen = !sidebarOpen">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" x-show="!sidebarOpen" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" x-show="sidebarOpen" />
            </svg>
        </div>


    @php
        $role = Auth::user()->role;
    @endphp

    @if ($role === 'admin_general')
        @include('components.sidebar-admin')
    @elseif ($role === 'technicien')
        @include('components.sidebar-technicien')
    @endif
</div>


    <!-- Mobile sidebar overlay -->
    <div class="fixed inset-0 bg-black bg-opacity-50 z-10" x-show="sidebarOpen && window.innerWidth < 1024" 
         @click="sidebarOpen = false" style="display: none;"></div>

    <!-- Main Content -->
    <div class="content-with-sidebar" :class="{ 'content-collapsed': !sidebarOpen }">
        <div class="min-h-screen">
            <!-- Header -->
            <header class="main-header bg-white shadow" :class="{ 'header-collapsed': !sidebarOpen }">
                @include('layouts.navigation')
            </header>

            <!-- Page Content -->
            <main class="main-content px-4 sm:px-6 lg:px-8">
    {{ $slot }}
</main>
        </div>
    </div>
</body>
</html> 