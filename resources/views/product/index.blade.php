@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <h3 class="text-3xl font-medium text-gray-700 mb-5">Products</h3>

    <div class="flex flex-wrap justify-between">
        <!-- Formulario de producto (lado izquierdo) -->
        <div class="w-full md:w-1/3 bg-white p-4 rounded-lg shadow-lg">
            <h4 class="text-lg font-medium mb-4">Add New Product</h4>

            <form method="POST"
                action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}"
                enctype="multipart/form-data">
                @csrf
                @if (isset($product))
                    @method('PUT') <!-- Método PUT para actualizar si es edición -->
                @endif

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" name="name" id="name" required
                        value="{{ isset($product) ? $product->name : old('name') }}"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ isset($product) ? $product->description : old('description') }}</textarea>
                </div>

                <!-- Price and Stock in the same row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" name="price" id="price" step="0.01" required
                            value="{{ isset($product) ? $product->price : old('price') }}"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Stock -->
                    <div class="mb-4">
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                        <input type="number" name="stock" id="stock" required
                            value="{{ isset($product) ? $product->stock : old('stock') }}"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        onchange="previewImage(event)">
                    <!-- Image Preview -->
                    <div class="mt-3">
                        <img id="imagePreview" class="w-32 h-32 object-cover rounded-md shadow-md"
                            src="{{ isset($product) ? asset('storage/' . $product->image) : '' }}"
                            style="{{ isset($product) ? 'display:block;' : 'display:none;' }}">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ isset($product) ? 'Update Product' : 'Add Product' }}
                </button>
            </form>


        </div>

        <!-- Tabla de productos (lado derecho) -->
        <div class="w-full md:w-2/3 mt-8 md:mt-0">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-500 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-16 py-3">
                                <span class="sr-only">Image</span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Qty
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr
                                class="bg-white border-b dark:bg-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="p-4">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        class="w-12 md:w-12 max-w-full max-h-full" alt="{{ $product->name }}">

                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-black">
                                    {{ $product->id }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-black">
                                    {{ $product->name }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-black">
                                    {{ $product->stock }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-black">
                                    ${{ number_format($product->price, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE') <!-- Método DELETE para la eliminación -->
                                        <button type="submit"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                            Remove
                                        </button>
                                    </form>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="font-medium text-yellow-500 dark:text-yellow-500 hover:underline">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0]; // Archivo seleccionado
            const preview = document.getElementById('imagePreview'); // Imagen de previsualización

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result; // Establece la fuente de la imagen
                    preview.style.display = "block"; // Muestra la imagen
                }

                reader.readAsDataURL(file); // Lee el archivo como una URL de datos
            } else {
                preview.style.display = "none"; // Oculta la vista previa si no hay archivo
            }
        }
    </script>

@endsection
