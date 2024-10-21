<!-- This is an example component -->
@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/menu.css'])

<head>
    <!-- Agregar Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<!-- Fondo de color amarillo más suave -->
<div class="bg-light-yellow min-h-screen">
    <header class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <!-- Logo -->
            @include('components.company-logo')

            <!-- Search Bar -->
            <div class="flex justify-center items-center w-full">
                <div class="flex items-center space-x-4">
                    @include('components.search-bar')
                    @include('components.search-button')
                </div>
            </div>

            <!-- User Profile -->
            @include('components.user-profile')
        </div>
    </header>

    <div class="container mx-auto py-8 px-6">
        <!-- Título del Menú -->
        <div class="text-center mb-4">
            <p class="text-yellow-600 font-bold uppercase tracking-wide mb-2">Our Menu</p>
            <h2 class="text-3xl font-bold">The Most Popular</h2>
        </div>

        <!-- Barra de Categorías Centradas -->
        <div class="categories-bar">
            <button onclick="filterProducts('burgers')" class="category-btn">
                <span class="material-icons">fastfood</span>
                <span>Burgers</span>
            </button>
            <button onclick="filterProducts('pizza')" class="category-btn">
                <span class="material-icons">local_pizza</span>
                <span>Pizza</span>
            </button>
            <button onclick="filterProducts('sushi')" class="category-btn">
                <span class="material-icons">set_meal</span>
                <span>Sushi</span>
            </button>
            <button onclick="filterProducts('snacks')" class="category-btn">
                <span class="material-icons">restaurant</span>
                <span>Snacks</span>
            </button>
            <button onclick="filterProducts('salads')" class="category-btn">
                <span class="material-icons">emoji_food_beverage</span>
                <span>Salads</span>
            </button>
            <button onclick="filterProducts('drinks')" class="category-btn">
                <span class="material-icons">local_cafe</span>
                <span>Drinks</span>
            </button>
            <button onclick="filterProducts('desserts')" class="category-btn">
                <span class="material-icons">cake</span>
                <span>Desserts</span>
            </button>
        </div>

        <!-- Productos Populares -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 mt-4">
            <!-- Tarjeta de Producto con atributo data-category -->

            <div class="product-card product-item" data-category="burgers" 
                onclick="openModal('Royal De Luxe', '{{ asset('images/hamburguesa.png') }}', '140 g', 'A delicious burger with deluxe ingredients.')">
                <span class="material-icons favorite-icon">favorite_border</span>
                <img src="{{ asset('images/hamburguesa.png') }}" alt="chese burguer" class="product-img">
                <h3 class="product-name">Hamburguesa</h3>
                <p class="product-weight">140 g</p>
                <div class="product-price">$100</div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>

            <div class="product-card product-item" data-category="pizza" 
                onclick="openModal('Royal De Luxe', '{{ asset('images/spaghetti.png') }}', '140 g', 'A delicious burger with deluxe ingredients.')">
                <span class="material-icons favorite-icon">favorite_border</span>
                <img src="{{ asset('images/spaghetti.png') }}" alt="Royal De Luxe" class="product-img">
                <h3 class="product-name">Spaghetti</h3>
                <p class="product-weight">140 g</p>
                <div class="product-price">$60</div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>

            <div class="product-card product-item" data-category="drinks" 
                onclick="openModal('Royal De Luxe', '{{ asset('images/jugo.png') }}', '140 g', 'A delicious burger with deluxe ingredients.')">
                <span class="material-icons favorite-icon">favorite_border</span>
                <img src="{{ asset('images/jugo.png') }}" alt="Royal De Luxe" class="product-img">
                <h3 class="product-name">Jugo de Naranja</h3>
                <p class="product-weight">600 ml</p>
                <div class="product-price">$40</div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>

            <div class="product-card product-item" data-category="drinks" 
                onclick="openModal('Royal De Luxe', '{{ asset('images/fish.png') }}', '140 g', 'A delicious burger with deluxe ingredients.')">
                <span class="material-icons favorite-icon">favorite_border</span>
                <img src="{{ asset('images/fish.png') }}" alt="Royal De Luxe" class="product-img">
                <h3 class="product-name">Tacos Fish</h3>
                <p class="product-weight">100 g</p>
                <div class="product-price">$35</div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>


            <div class="product-card product-item" data-category="snacks" 
                onclick="openModal('Royal De Luxe', '{{ asset('images/sabritas.png') }}', '140 g', 'A delicious burger with deluxe ingredients.')">
                <span class="material-icons favorite-icon">favorite_border</span>
                <img src="{{ asset('images/sabritas.png') }}" alt="Royal De Luxe" class="product-img">
                <h3 class="product-name">Sabritas</h3>
                <p class="product-weight">100 g</p>
                <div class="product-price">$20</div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>

            <div class="product-card product-item" data-category="desserts" 
                onclick="openModal('Royal De Luxe', '{{ asset('images/dessert.png') }}', '140 g', 'A delicious burger with deluxe ingredients.')">
                <span class="material-icons favorite-icon">favorite_border</span>
                <img src="{{ asset('images/dessert.png') }}" alt="Royal De Luxe" class="product-img">
                <h3 class="product-name">Pay</h3>
                <p class="product-weight">150 g</p>
                <div class="product-price">$45</div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>

            <div class="product-card product-item" data-category="drinks" 
                onclick="openModal('Royal De Luxe', '{{ asset('images/coffe.png') }}', '140 g', 'A delicious burger with deluxe ingredients.')">
                <span class="material-icons favorite-icon">favorite_border</span>
                <img src="{{ asset('images/coffe.png') }}" alt="Royal De Luxe" class="product-img">
                <h3 class="product-name">Cafe</h3>
                <p class="product-weight">100 ml</p>
                <div class="product-price">$20</div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>

            <div class="product-card product-item" data-category="burgers" 
                onclick="openModal('Royal De Luxe', '{{ asset('images/hamburguesa.png') }}', '140 g', 'A delicious burger with deluxe ingredients.')">
                <span class="material-icons favorite-icon">favorite_border</span>
                <img src="{{ asset('images/hamburguesa.png') }}" alt="chese burguer" class="product-img">
                <h3 class="product-name">Hamburguesa</h3>
                <p class="product-weight">140 g</p>
                <div class="product-price">$100</div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>

        </div>
    </div>
</div>

<!-- JavaScript para manejar la lógica de filtrado -->
<script>
    function filterProducts(category) {
        const products = document.querySelectorAll('.product-item');
        products.forEach(product => {
            if (product.dataset.category === category || category === 'all') {
                product.style.display = 'flex';
            } else {
                product.style.display = 'none';
            }
        });
    }

    function openModal(productName, productImage, productWeight, productDescription) {
    document.getElementById('modalProductName').textContent = productName;
    document.getElementById('modalProductImage').src = productImage;
    document.getElementById('modalProductWeight').textContent = productWeight;
    document.getElementById('modalProductDescription').textContent = productDescription;

    const productModal = document.getElementById('productModal');
    productModal.classList.add('active');
    productModal.classList.remove('hidden');

    productModal.addEventListener('click', function(event) {
        const modalContent = document.querySelector('.modal-content');
        if (!modalContent.contains(event.target)) {
            closeModal();
        }
    });
}

function closeModal() {
    const productModal = document.getElementById('productModal');
    productModal.classList.remove('active');
    productModal.classList.add('hidden');
}


const ingredients = [
    "Sin Cebolla",
    "Sin Catsup",
    "Sin Mostaza",
    "Sin Pepinillos",
    "Sin Mayonesa",
    "Sin Queso",
    "Sin Tocino",
    "Sin Tomate"
];

let selectedIngredients = [];

function loadIngredients() {
    const ingredientsList = document.getElementById('ingredientsList');
    ingredientsList.innerHTML = '';

    ingredients.forEach(ingredient => {
        const li = document.createElement('li');
        li.innerHTML = `
            <span class="ingredient-name">${ingredient}</span>
            <button class="add-remove-btn" onclick="toggleIngredient('${ingredient}')">+</button>
        `;
        ingredientsList.appendChild(li);
    });
}

function toggleIngredient(ingredient) {
    const index = selectedIngredients.indexOf(ingredient);

    if (index > -1) {
        // Si el ingrediente ya está seleccionado, lo eliminamos
        selectedIngredients.splice(index, 1);
    } else if (selectedIngredients.length < 8) {
        // Si el ingrediente no está seleccionado y el límite no se ha alcanzado, lo agregamos
        selectedIngredients.push(ingredient);
    }

    // Actualiza el botón de agregar o quitar
    updateIngredientsUI();
}

function updateIngredientsUI() {
    const ingredientItems = document.querySelectorAll('.ingredients-list li');

    ingredientItems.forEach(item => {
        const ingredientName = item.querySelector('.ingredient-name').textContent;
        const addRemoveBtn = item.querySelector('.add-remove-btn');

        if (selectedIngredients.includes(ingredientName)) {
            addRemoveBtn.textContent = '-';
            addRemoveBtn.style.backgroundColor = '#ffcc80';
        } else {
            addRemoveBtn.textContent = '+';
            addRemoveBtn.style.backgroundColor = '#f1f1f1';
        }
    });
}

// Cargar los ingredientes al abrir el modal
function openModal(productName, productImage, productWeight, productDescription) {
    document.getElementById('modalProductName').textContent = productName;
    document.getElementById('modalProductImage').src = productImage;
    document.getElementById('modalProductWeight').textContent = productWeight;
    document.getElementById('modalProductDescription').textContent = productDescription;

    const productModal = document.getElementById('productModal');
    productModal.classList.add('active');
    productModal.classList.remove('hidden');

    // Carga los ingredientes disponibles
    loadIngredients();

    // Agregar un evento para cerrar el modal al hacer clic fuera de su contenido
    productModal.addEventListener('click', function(event) {
        const modalContent = document.querySelector('.modal-content');
        if (!modalContent.contains(event.target)) {
            closeModal();
        }
    });
}


document.getElementById('cartIcon').addEventListener('click', function() {
    const cartDropdown = document.getElementById('cartDropdown');
    cartDropdown.classList.toggle('hidden');
    cartDropdown.classList.toggle('active');
});

// Cerrar el dropdown si se hace clic fuera de él
document.addEventListener('click', function(event) {
    const cartDropdown = document.getElementById('cartDropdown');
    const cartIcon = document.getElementById('cartIcon');
    
    if (!cartDropdown.contains(event.target) && !cartIcon.contains(event.target)) {
        cartDropdown.classList.add('hidden');
        cartDropdown.classList.remove('active');
    }
});




</script>

<!-- Modal para mostrar información del producto -->
<div id="productModal" class="modal-overlay hidden">
    <div class="modal-content">
        <img id="modalProductImage" src="" alt="Product Image" class="modal-img">
        <h3 id="modalProductName" class="modal-title">Producto</h3>
        <p id="modalProductWeight" class="modal-weight">Peso</p>
        <p id="modalProductDescription" class="modal-description">Descripción</p>

        <!-- Sección de ingredientes -->
        <div class="ingredients-section">
            <h4 class="ingredients-title">Sin siguientes ingredientes</h4>
            <p class="ingredients-subtitle">Selecciona hasta 8</p>
            <ul id="ingredientsList" class="ingredients-list">
                <!-- Los ingredientes se generarán dinámicamente -->
            </ul>
        </div>

        <button class="modal-add-to-cart-btn" onclick="addToCartFromModal()">Agrega al carrito</button>
    </div>
</div>