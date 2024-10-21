<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\InventoryAdjustment;


use Illuminate\Support\Facades\Cache;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productTypes = ProductType::all();
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        // Cargar la relación 'productType'
        $query = Product::with('productType');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('price', 'like', '%' . $search . '%');
        }

        $products = $query->paginate($perPage);

        if ($request->ajax()) {
            return view('admin.products.partials._products_table', compact('products'))->render();
        }

        return view('admin.products.index', compact('products', 'productTypes'));
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'product_type_id' => 'required|exists:product_types,id',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        // Si tienes optimización de imágenes
        if ($imagePath) {
            $fullPath = storage_path('app/public/' . str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $imagePath));
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize($fullPath);
        }

        // Crear el producto
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'product_type_id' => $request->product_type_id,
        ]);

        // Registrar el ajuste de inventario
        InventoryAdjustment::create([
            'product_id' => $product->id,
            'previous_stock' => 0, // Nuevo producto, el stock anterior es 0
            'new_stock' => $request->stock,
            'admin_id' => auth()->id(), // Si estás usando autenticación de Laravel para identificar al admin
        ]);

        return redirect()->route('products')->with('success', 'Product added and inventory adjusted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Subir nueva imagen si se proporciona una, sino mantener la actual
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $product->image = $imagePath;
        }

        // Guardar el stock anterior para registrar el ajuste de inventario
        $previousStock = $product->stock;

        // Actualizar los datos del producto
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $product->image, // Mantener la imagen actual si no se cambia
        ]);

        // Registrar el ajuste de inventario si hay un cambio en el stock
        if ($previousStock != $request->stock) {
            if (isset($product->id)) {
                InventoryAdjustment::create([
                    'product_id' => $product->id,
                    'previous_stock' => $previousStock,
                    'new_stock' => $request->stock,
                    'admin_id' => auth()->id(), // ID del administrador autenticado
                ]);
            } else {
                // Manejar el caso donde no hay $product->id
                return back()->withErrors('No se pudo encontrar el ID del producto.');
            }
        }


        return redirect()->route('products')->with('success', 'Product updated and inventory adjusted successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    // app/Http/Controllers/ProductController.php
    public function destroy(Product $product)
    {
        // Eliminar el producto
        $product->delete();

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('products')->with('success', 'Product deleted successfully.');
    }
}
