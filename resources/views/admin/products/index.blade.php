@extends('layouts.app')

@section('title', 'Products')

@section('content')

    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-5 space-y-3 lg:space-y-0">
        <h3 class="text-2xl lg:text-3xl font-medium text-gray-700">Products</h3>

        <div class="flex flex-wrap space-y-3 lg:space-y-0 space-x-0 lg:space-x-3 items-center">
            <!-- Search Form -->
            <form method="GET" action="{{ route('products') }}" id="productsSearchForm" class="flex items-center">
                <div class="relative w-full sm:w-auto">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" id="searchInput" name="search"
                        class="appearance-none w-full sm:w-64 bg-white text-black border-none rounded-2xl text-sm px-4 py-2 pl-10 pr-10 focus:outline-none"
                        placeholder="Search products" value="{{ request('search') }}">
                </div>
            </form>

            <!-- Showing Dropdown -->
            <form method="GET" action="{{ route('products') }}" id="productsPerPageForm" class="flex items-center">
                <div class="relative">
                    <select name="per_page" onchange="document.getElementById('productsPerPageForm').submit();"
                        class="appearance-none bg-gray-300 text-black border-none rounded-md text-sm px-4 py-2 pr-8 focus:outline-none">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>
            </form>

            <!-- Filter Button -->
            <button
                class="bg-gray-100 flex items-center px-3 py-2 rounded-md text-gray-600 hover:bg-blue-500 hover:text-white transition-colors duration-200">
                <i class="fa-solid fa-filter mr-2"></i>
                Filter
            </button>

            <!-- Export Button -->
            <button
                class="bg-gray-100 flex items-center px-3 py-2 rounded-md text-gray-600 hover:bg-blue-500 hover:text-white transition-colors duration-200">
                <i class="fa-solid fa-file-export mr-2"></i>
                Export
            </button>

            <!-- Add Product Button -->
            <button onclick="openModal('add')"
                class="bg-blue-500 hover:bg-blue-600 text-white flex items-center px-4 py-2 rounded-md">
                <i class="fa-solid fa-plus mr-2"></i>
                Add New Product
            </button>
        </div>
    </div>



    <div class="w-full max-w-full  mb-6  mx-auto">
        <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border bg-white m-5">
            <div
                class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border  border-stone-200 bg-light/30">
                <!-- card body  -->
                    <div class="bg-white  overflow-hidden shadow-md">
                        <table class="min-w-full text-sm bg-white shadow-md overflow-hidden">
                            <thead class="bg-gray-100 text-gray-600">
                                <tr>
                                    <th class="px-6 py-3 text-left font-semibold">ID</th>
                                    <th class="px-6 py-3 text-left font-semibold">Product Name</th>
                                    <th class="px-6 py-3 text-left font-semibold">Description</th>
                                    <th class="px-6 py-3 text-center font-semibold">Price</th>
                                    <th class="px-6 py-3 text-center font-semibold">Stock</th>
                                    <th class="px-6 py-3 text-center font-semibold">Type</th>
                                    <th class="px-6 py-3 text-center font-semibold">Action</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @forelse($products as $product)
                                    <tr class="border-b hover:bg-gray-100 transition">
                                        <!-- ID Column -->
                                        <td class="px-6 py-4 text-gray-700">{{ $product->id }}</td>
                        
                                        <!-- Product Name Column -->
                                        <td class="px-6 py-4 flex items-center space-x-3">
                                            <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden shadow-sm">
                                                <img src="{{ isset($product) ? asset('storage/' . $product->image) : '' }}"
                                                     alt="{{ $product->name }}"
                                                     class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $product->name }}</div>
                                                <div class="text-xs text-gray-500">Product ID: {{ $product->id }}</div>
                                            </div>
                                        </td>
                        
                                        <!-- Description Column -->
                                        <td class="px-6 py-4 text-gray-600 truncate max-w-xs">{{ $product->description }}</td>
                        
                                        <!-- Price Column -->
                                        <td class="px-6 py-4 text-center">
                                            <span class="text-lg font-semibold text-green-600">
                                                ${{ number_format($product->price, 2) }}
                                            </span>
                                        </td>
                        
                                        <!-- Stock Column -->
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $product->stock }}
                                            </span>
                                        </td>
                        
                                        <!-- Type Column -->
                                        <td class="px-6 py-4 text-center text-gray-700">
                                            {{ $product->productType ? $product->productType->name : 'N/A' }}
                                        </td>
                        
                                        <!-- Action Column -->
                                        <td class="px-6 py-4 flex justify-center space-x-3">
                                            <!-- Edit Button -->
                                            <a href="javascript:void(0)"
                                               onclick="openModal('edit', {{ json_encode($product) }})"
                                               class="text-blue-500 hover:text-blue-700 transition">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                        
                                            <!-- Delete Button -->
                                            <button type="button"
                                                    onclick="openDeleteModal({{ $product->id }})"
                                                    class="text-red-500 hover:text-red-700 transition">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-6 text-gray-500">No products available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        

                        <div class="mt-4">
                            {{ $products->appends(['per_page' => request('per_page'), 'search' => request('search')])->links() }}
                        </div>

                    </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="productModal" class="fixed z-50 inset-0 overflow-y-auto hidden flex items-center justify-center px-4">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg w-full mx-2">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg w-full">
                <div class="bg-gray-100 px-4 py-3 flex justify-between items-center">
                    <h3 id="modalTitle" class="text-lg font-medium text-gray-900">Add New Product</h3>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
                <form id="productForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="methodField"></div>
                    <!-- Este div es para añadir el campo @method('PUT') en caso de edición -->
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
                        <div class="flex space-x-4">
                            <div class="w-1/2">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="number" name="price" id="price" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                            </div>

                            <div class="w-1/2">
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                                <input type="number" name="stock" id="stock"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label for="product_type_id" class="block text-sm font-medium text-gray-700">Product
                                Type</label>
                            <select name="product_type_id" id="product_type_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">Select a product type</option>
                                @foreach ($productTypes as $productType)
                                    <option value="{{ $productType->id }}">{{ $productType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                            <input type="file" name="image" id="image"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm"
                            id="submitButton">Save</button>
                        <button type="button" onclick="closeModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación de eliminación -->
    <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg w-full">
                <div class="bg-gray-100 px-4 py-3 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Delete Product</h3>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="px-4 py-5 space-y-4">
                        <p class="text-sm text-gray-500">Are you sure you want to delete this product? This action cannot
                            be undone.</p>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="inline-flex justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500">
                            Delete
                        </button>
                        <button type="button" onclick="closeModal()"
                            class="mt-3 inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-50 sm:mt-0">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        let productModal = document.getElementById('productModal');
        let productForm = document.getElementById('productForm');
        let modalTitle = document.getElementById('modalTitle');
        let submitButton = document.getElementById('submitButton');
        let methodField = document.getElementById('methodField');
        let timer;
        const searchInput = document.getElementById('searchInput');

        function openModal(action = 'add', product = null) {
            // Limpiar el formulario y el método por defecto
            productForm.reset();
            methodField.innerHTML = ''; // Limpiar el método para evitar conflictos

            if (action === 'edit') {
                modalTitle.innerText = 'Edit Product';
                submitButton.innerText = 'Update';

                // Cambiar la acción del formulario a la ruta de actualización
                productForm.action = `/products/${product.id}`;
                methodField.innerHTML = '@method('PUT')'; // Añadir método PUT para edición

                // Rellenar los campos con los datos del producto
                document.getElementById('name').value = product.name;
                document.getElementById('description').value = product.description;
                document.getElementById('price').value = product.price;
                document.getElementById('stock').value = product.stock;
                document.getElementById('product_type_id').value = product.product_type_id;
            } else {
                modalTitle.innerText = 'Add New Product';
                submitButton.innerText = 'Save';

                // Cambiar la acción del formulario a la ruta de creación
                productForm.action = '/products';
            }

            productModal.classList.remove('hidden');
        }

        function openDeleteModal(productId) {
            var form = document.getElementById('deleteForm');
            form.action = '/products/' + productId; // Actualiza la URL
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('productModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.add('hidden');
        }

        searchInput.addEventListener('input', function() {
            clearTimeout(timer); // Limpiar el temporizador anterior si el usuario sigue escribiendo

            timer = setTimeout(function() {
                const searchQuery = searchInput.value;

                // Hacer la petición AJAX
                fetch(
                        `{{ route('products') }}?search=${searchQuery}&per_page={{ request('per_page', 10) }}`
                    )
                    .then(response => response.text()) // Obtener el HTML como respuesta
                    .then(data => {
                        // Reemplazar el contenido de la tabla con los resultados filtrados
                        document.querySelector('tbody').innerHTML = new DOMParser()
                            .parseFromString(data, 'text/html')
                            .querySelector('tbody').innerHTML;
                    })
                    .catch(error => console.error('Error:', error));
            }, 300); // 300 ms de debounce
        });
    </script>

@endsection
