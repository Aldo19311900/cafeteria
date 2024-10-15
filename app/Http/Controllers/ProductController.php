<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener el valor de la cantidad de productos a mostrar, por defecto 10
        $perPage = $request->input('per_page', 10); // Obtiene el valor de 'per_page', si no existe, usa 10 como valor predeterminado
    
        // Obtener los productos con paginación
        $products = Product::paginate($perPage);
    
        return view('admin.products.index', compact('products'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',    
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public'); // Guarda la imagen en la carpeta "uploads"
        }
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);
    
        return redirect()->route('products')->with('success', 'Product added successfully.');
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

    // Actualizar los datos del producto
    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'image' => $product->image, // Se mantiene la imagen actual si no se cambia
    ]);

    // Redirige de nuevo al index con un mensaje de éxito
    return redirect()->route('products')->with('success', 'Product updated successfully.');
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
