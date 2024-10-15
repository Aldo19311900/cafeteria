<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
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
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-white lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <i class="fa-solid fa-shop fa-2x"></i>
                    <span class="mx-2 text-2xl font-semibold text-black">Cafeteria</span>
                </a>
                
            </div>

            <!-- Navigation Links -->
            <nav class="mt-10">
                <a class="flex items-center px-6 py-2 mt-4 text-white bg-blue-700 href="{{ route('dashboard') }}">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                    <span class="mx-3">Dashboard</span>
                </a>
                <a class="flex items-center px-6 py-2 mt-4 text-black hover:bg-blue-700 hover:text-white" href="{{ route('users') }}">
                    <i class="fa-solid fa-user"></i>
                    <span class="mx-3">Users</span>
                </a>
                <a class="flex items-center px-6 py-2 mt-4 text-black  hover:bg-blue-700 hover:text-white"   href="{{ route('products') }}">
                    <i class="fas fa-box-open"></i>

                    <span class="mx-3">Products</span>
                </a>
                <a class="flex items-center px-6 py-2 mt-4 text-black  hover:bg-blue-700 hover:text-white"   href="{{ route('products') }}">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zM10 0h2a2 2 0 012 2v2a2 2 0 01-2 2H10a2 2 0 01-2-2V2a2 2 0 012-2z"></path>
                    </svg>
                    <span class="mx-3">Statistics</span>
                </a>
                <a class="flex items-center px-6 py-2 mt-4 text-black  hover:bg-blue-700 hover:text-white"   href="#">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zM10 0h2a2 2 0 012 2v2a2 2 0 01-2 2H10a2 2 0 01-2-2V2a2 2 0 012-2z"></path>
                    </svg>
                    <span class="mx-3">Inventory</span>
                </a>
                <a class="flex items-center px-6 py-2 mt-4 text-black  hover:bg-blue-700 hover:text-white"   href="#">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zM10 0h2a2 2 0 012 2v2a2 2 0 01-2 2H10a2 2 0 01-2-2V2a2 2 0 012-2z"></path>
                    </svg>
                    <span class="mx-3">Transactions</span>
                </a>
                <!-- Add more links here -->
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Header -->
            <header class="flex items-center justify-between px-6 py-4 bg-gray-200 border-b-4">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>

                    <!-- Search bar -->
                    <div class="relative mx-4 lg:mx-0">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input class="w-100 pl-10 pr-4 rounded-full form-input sm:w-64 focus:border-indigo-600" type="text" placeholder="Search">
                    </div>
                </div>

                <!-- Avatar dropdown -->
                <div class="flex items-center">
                    <div x-data="{ dropdownOpen: false }" class="relative flex items-center space-x-3">
                        <!-- Avatar button -->
                        <button @click="dropdownOpen = ! dropdownOpen" class="relative block w-12 h-12 overflow-hidden rounded-full shadow focus:outline-none">
                            <img class="object-cover w-full h-full" src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=296&q=80" alt="{{ Auth::user()->name }}">
                        </button>
                    
                        <!-- User Info (Name and Email) -->
                        <div class="flex flex-col">
                            <span class="font-semibold text-gray-900">{{ Auth::user()->name }}</span>
                            <span class="text-sm text-gray-500">{{ Auth::user()->email }}</span>
                        </div>
                        <a  @click="dropdownOpen = ! dropdownOpen">
                            <i class="fa-solid fa-chevron-down"></i></a>
                    
                        <!-- Dropdown content -->
                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full" style="display: none;"></div>
                        <div x-show="dropdownOpen" class="absolute right-0 z-10 w-48 mt-28 overflow-hidden bg-white rounded-md shadow-xl" style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                                {{ __('Profile') }}
                            </a>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white" onclick="event.preventDefault(); this.closest('form').submit();">
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
