<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @laravelPWA
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
            class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
            class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-white lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <i class="fa-solid fa-shop fa-2x"></i>
                    <span class="mx-2 text-2xl font-semibold text-black">Cafeteria</span>
                </a>

            </div>

            <!-- Navigation Links -->
            <nav class="mt-10">
                <a class="flex items-center px-6 py-2 mt-4 {{ Route::is('dashboard') ? 'bg-blue-700 text-white' : 'text-black hover:bg-blue-700 hover:text-white' }}" 
                href="{{ route('dashboard') }}">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
                <span class="mx-3">Dashboard</span>
            </a>
            
            <!-- Users -->
            <a class="flex items-center px-6 py-2 mt-4 {{ Route::is('users') ? 'bg-blue-700 text-white' : 'text-black hover:bg-blue-700 hover:text-white' }}" 
                href="{{ route('users') }}">
                <i class="fa-solid fa-user"></i>
                <span class="mx-3">Users</span>
            </a>
        
            <!-- Products -->
            <a class="flex items-center px-6 py-2 mt-4 {{ Route::is('products') ? 'bg-blue-700 text-white' : 'text-black hover:bg-blue-700 hover:text-white' }}" 
                href="{{ route('products') }}">
                <i class="fas fa-box-open"></i>
                <span class="mx-3">Products</span>
            </a>
        
            <!-- Statistics -->
            <a class="flex items-center px-6 py-2 mt-4 {{ Route::is('statistics') ? 'bg-blue-700 text-white' : 'text-black hover:bg-blue-700 hover:text-white' }}" 
                href="">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zM10 0h2a2 2 0 012 2v2a2 2 0 01-2 2H10a2 2 0 01-2-2V2a2 2 0 012-2z"></path>
                </svg>
                <span class="mx-3">Statistics</span>
            </a>
                <a class="flex items-center px-6 py-2 mt-4 text-black  hover:bg-blue-700 hover:text-white"
                    href="{{route('inventory.adjustments')}}">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zM10 0h2a2 2 0 012 2v2a2 2 0 01-2 2H10a2 2 0 01-2-2V2a2 2 0 012-2z">
                        </path>
                    </svg>
                    <span class="mx-3">Inventory</span>
                </a>
                <a class="flex items-center px-6 py-2 mt-4 text-black  hover:bg-blue-700 hover:text-white"
                    href="{{route('transactions')}}">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zM10 0h2a2 2 0 012 2v2a2 2 0 01-2 2H10a2 2 0 01-2-2V2a2 2 0 012-2z">
                        </path>
                    </svg>
                    <span class="mx-3">Transactions</span>
                </a>
                <!-- Add more links here -->
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Header -->
            <header class="flex flex-wrap items-center justify-between p-4 bg-gray-800 text-white shadow-lg">
                <!-- Left Section -->
                <div class="flex items-center space-x-4 w-full lg:w-auto">
                    <!-- Sidebar Toggle -->
                    <button @click="sidebarOpen = true" class="text-gray-300 focus:outline-none lg:hidden">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
            
                    <!-- Search Bar -->
                    <div class="relative w-full lg:w-auto mx-4 mt-2 lg:mt-0">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input
                            class="w-full lg:w-32 pl-10 pr-4 py-2 bg-gray-700 text-white rounded-full focus:w-full lg:focus:w-64 focus:outline-none transition-all duration-300"
                            type="text" placeholder="Search">
                    </div>
                </div>
            
                <!-- Center Section (Date & Time) -->
                <div class="hidden lg:flex items-center space-x-6 mx-auto mt-2 lg:mt-0">
                    <div class="text-sm font-medium">
                        <span>{{ now()->format('h:i A') }}</span>
                        <span class="text-gray-400">|</span>
                        <span>{{ now()->format('d M Y') }}</span>
                    </div>
                </div>
            
                <!-- Right Section -->
                <div class="flex items-center space-x-4 w-full lg:w-auto mt-2 lg:mt-0 justify-end">
                    <!-- Help Icon -->
                    <a href="#" class="text-gray-300 hover:text-gray-100 transition duration-200">
                        <i class="fa-solid fa-circle-question text-xl"></i>
                    </a>
            
                    <!-- Notifications Icon -->
                    <button class="relative text-gray-300 hover:text-gray-100 transition duration-200">
                        <i class="fa-solid fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full animate-ping"></span>
                    </button>
            
                    <!-- Language Selector -->
                    <div class="relative inline-block">
                        <select
                            class="appearance-none bg-gray-700 text-white py-1 pr-8 pl-2 rounded-md focus:outline-none cursor-pointer">
                            <option value="en">EN</option>
                            <option value="es">ES</option>
                        </select>
                    </div>
            
                    <!-- Avatar & User Info Dropdown -->
                    <div x-data="{ dropdownOpen: false }" class="relative flex items-center space-x-2">
                        <!-- Avatar Button -->
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="relative block w-10 h-10 rounded-full overflow-hidden shadow focus:outline-none">
                            <img class="object-cover w-full h-full"
                                src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&auto=format&fit=crop&w=296&q=80"
                                alt="{{ Auth::user()->name }}">
                        </button>
            
                        <!-- User Info (Visible in lg) -->
                        <div class="hidden lg:flex flex-col items-start">
                            <span class="font-semibold text-sm">{{ Auth::user()->name }}</span>
                            <span class="text-xs text-gray-400">{{ Auth::user()->email }}</span>
                        </div>
            
                        <!-- Dropdown Toggle -->
                        <button @click="dropdownOpen = !dropdownOpen" class="text-gray-300 focus:outline-none">
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
            
                        <!-- Dropdown Content -->
                        <div x-show="dropdownOpen" @click="dropdownOpen = false"
                            class="fixed inset-0 z-10 w-full h-full bg-transparent" style="display: none;"></div>
                        <div x-show="dropdownOpen"
                            class="absolute right-0 z-20 w-48 mt-16 bg-white rounded-md shadow-lg overflow-hidden transition transform origin-top-right"
                            style="display: none;">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                                {{ __('Profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-600 hover:text-white"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>

</html>
<script>
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/js/sw.js')
        .then(registration => {
          console.log('Service Worker registered with scope:', registration.scope);
        })
        .catch(error => {
          console.log('Service Worker registration failed:', error);
        });
    }
  </script>
  