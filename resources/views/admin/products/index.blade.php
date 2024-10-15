@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="flex justify-between items-center mb-5">
        <h3 class="text-3xl font-medium text-gray-700">Products</h3>

        <div class="flex space-x-3 items-center">
            <!-- Showing -->
            <span class="text-gray-600 mr-2">Showing</span>
            <form method="GET" action="{{ route('products') }}" id="productsPerPageForm">
                <div class="relative">
                    <select name="per_page" onchange="document.getElementById('productsPerPageForm').submit();"
                        class="appearance-none bg-gray-300 text-black border-none rounded-md text-sm px-4 py-2 pr-8 focus:outline-none">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <!-- Optionally, you can add an icon here for the select -->
                    </div>
                </div>
            </form>

            <!-- Filter -->
            <div>
                <button
                    class="bg-gray-100 flex items-center px-3 py-2 rounded-md text-gray-600 hover:bg-blue-500 hover:text-white transition-colors duration-200">
                    <i class="fa-solid fa-filter mr-2"></i>
                    Filter
                </button>
            </div>

            <!-- Export -->
            <div>
                <button
                    class="bg-gray-100 flex items-center px-3 py-2 rounded-md text-gray-600 hover:bg-blue-500 hover:text-white transition-colors duration-200">
                    <i class="fa-solid fa-file-export mr-2"></i>
                    Export
                </button>
            </div>


            <!-- Add Product Button -->
            <div>
                <button onclick="openModal()"
                    class="bg-blue-500 hover:bg-blue-600 text-white flex items-center px-4 py-2 rounded-md">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add New Product
                </button>
            </div>
        </div>
    </div>


    <div class="w-full max-w-full  mb-6  mx-auto">
        <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
            <div
                class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
                <!-- card body  -->
                <div class="flex-auto block py-8 pt-6 px-9">
                    <div class="overflow-x-auto">
                        <table class="w-full my-0 align-middle text-dark border-neutral-200">
                            <thead class="align-bottom text-center">
                                <tr class="font-semibold text-[0.95rem] text-secondary-dark">
                                    <th class="pb-3 text-start min-w-[175px]">Product Name</th>
                                    <th class="pb-3 text-center min-w-[100px]">Product ID</th>
                                    <th class="pb-3 text-center min-w-[100px]">Price</th>
                                    <th class="pb-3 pr-12 text-center min-w-[175px]">Stock</th>
                                    <th class="pb-3 pr-12 text-center min-w-[100px]">Type</th>
                                    <th class="pb-3 text-center min-w-[50px]">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr class="border-b border-dashed last:border-b-0">
                                        <td class="p-1.5 pl-0">
                                            <div class="flex items-center">
                                                <div class="relative inline-block shrink-0 rounded-2xl me-3">
                                                    <img src="{{ isset($product) ? asset('storage/' . $product->image) : '' }}"
                                                        loading="lazy"
                                                        class="w-[40px] h-[40px] inline-block shrink-0 rounded-2xl"
                                                        alt="{{ $product->name }}">

                                                </div>
                                                <div class="flex flex-col justify-start">
                                                    <span
                                                        class="mb-1 font-semibold transition-colors duration-200 ease-in-out text-sm text-secondary-inverse hover:text-primary">

                                                        {{ $product->name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-1.5 pr-0 text-center">
                                            <span
                                                class="font-semibold text-light-inverse text-sm">{{ $product->id }}</span>

                                        </td>
                                        <td class="p-2.5 pr-0 text-center">
                                            <span
                                                class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-sm text-success bg-success-light rounded-lg">
                                                ${{ number_format($product->price, 2) }}
                                            </span>
                                        </td>
                                        <td class="p-1.5 pr-12 text-center">
                                            <span
                                                class="text-center align-baseline inline-flex px-3 py-2 mr-auto items-center font-semibold text-sm text-primary bg-primary-light rounded-lg">
                                                {{ $product->stock }}
                                            </span>
                                        </td>
                                        <td class="p-1.5 text-center">
                                            <span
                                                class="font-semibold text-light-inverse text-sm">{{ $product->type }}</span>

                                        </td>
                                        <td class="p-1.5 pr-0 text-center relative flex justify-center space-x-2">
                                            <!-- Botón Editar -->
                                            <a href="{{ route('products.edit', $product->id) }}" class="text-gray-800 hover:text-orange-600">
                                                <i class="fa-solid fa-pen-to-square"></i> <!-- Ícono de editar -->
                                            </a>
                                        
                                            <!-- Botón Eliminar -->
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="openDeleteModal()" class="text-gray-800 hover:text-red-600">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                        

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center p-5">
                                            No products available.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                        <div class="mt-4">
                            {{ $products->appends(['per_page' => request('per_page')])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="productModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg w-full">
                <div class="bg-gray-100 px-4 py-3 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Add New Product</h3>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="px-4 py-5 space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required></textarea>
                        </div>
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" id="price" step="0.01"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="number" name="stock" id="stock"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                            <input type="file" name="image" id="image"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
                        <button type="button" onclick="closeModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación -->
<div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg w-full">
            <div class="bg-gray-100 px-4 py-3 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Delete Product</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <div class="px-4 py-5 space-y-4">
                <p class="text-sm text-gray-500">Are you sure you want to delete this product? This action cannot be undone.</p>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse">
                <!-- Formulario de eliminación dentro del modal -->
                <form id="deleteForm" method="POST" action="{{ route('products.destroy', $product->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500">
                        Delete
                    </button>
                </form>
                <button type="button" onclick="closeModal()" class="mt-3 inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-50 sm:mt-0">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

    <script>
        function openModal() {
            document.getElementById('productModal').classList.remove('hidden');
        }
    
        function openDeleteModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('productModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.add('hidden');
    }
    </script>
@endsection
