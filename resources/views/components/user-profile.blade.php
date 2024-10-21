<div class="flex items-center space-x-4 relative">
    <!-- Carrito de Compras -->
    <button class="relative" id="cartIcon">
        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6H19m0 0a2 2 0 11-4 0m4 0a2 2 0 10-4 0"></path>
        </svg>
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-semibold rounded-full px-1.5" id="cartCount">2</span>
    </button>

    <!-- Dropdown del carrito -->
    <div id="cartDropdown" class="hidden">
        <h4 class="text-lg font-bold mb-2">Carrito de Compras</h4>
        <ul id="cartItems" class="mb-4">
            <!-- Lista de productos del carrito -->
            <li class="flex justify-between items-center py-2 border-b">
                <span>Royal De Luxe</span>
                <span class="text-sm text-gray-600">$2.50</span>
            </li>
            <li class="flex justify-between items-center py-2 border-b">
                <span>Chicken Roll</span>
                <span class="text-sm text-gray-600">$4.50</span>
            </li>
        </ul>
        <button id="goToFullCart" class="w-full bg-yellow-500 text-white font-bold py-2 rounded-lg">Ir al carrito</button>
    </div>

    <!-- User Avatar -->
    <div class="flex items-center">
        <img src="{{ asset('images/avatars/avatar.png') }}" alt="User Avatar" class="h-8 w-8 rounded-full">
    </div>
</div>
