<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Lista de nombres de productos
        $productNames = [
            'Jugo de Naranja', 'Jugo de Manzana', 'Coca Cola', 'Refresco de Limón',
            'Agua Mineral', 'Sabritas Clásicas', 'Sabritas Limón', 'Doritos', 'Ruffles Queso',
            'Cheetos', 'Galletas Oreo', 'Galletas Marías', 'Galletas Emperador',
            'Barra de Granola', 'Barra Energética', 'Chocolatina', 'Paleta de Fresa',
            'Paleta de Mango', 'Helado de Vainilla', 'Helado de Chocolate', 'Pastel de Chocolate',
            'Sandwich de Jamón', 'Sandwich de Pollo', 'Ensalada de Frutas', 'Tamal de Rajas',
            'Tamal de Verde', 'Churros', 'Tostitos', 'Papitas Fritas', 'Chicharrón de Harina'
        ];

        foreach ($productNames as $name) {
            Product::create([
                'name' => $name, // Usamos los nombres específicos de productos
                'description' => $faker->sentence, // Descripción breve
                'price' => $faker->randomFloat(2, 5, 100), // Precio entre 5 y 100
                'stock' => $faker->numberBetween(10, 100), // Stock entre 10 y 100
                'image' => 'uploads/' . $faker->lexify('product_image_????.jpg'), // Ruta de imagen
            ]);
        }
    }
}
