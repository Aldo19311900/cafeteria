<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $productTypes = [
            ['id' => 1, 'name' => 'Burgers', 'description' => 'All kinds of burgers'],
            ['id' => 2, 'name' => 'Pizza', 'description' => 'Different varieties of pizza'],
            ['id' => 3, 'name' => 'Sushi', 'description' => 'Various types of sushi'],
            ['id' => 4, 'name' => 'Snacks', 'description' => 'Quick and tasty snacks'],
            ['id' => 5, 'name' => 'Salads', 'description' => 'Fresh and healthy salads'],
            ['id' => 6, 'name' => 'Drinks', 'description' => 'Refreshing drinks'],
            ['id' => 7, 'name' => 'Desserts', 'description' => 'Sweet desserts'],
        ];

        DB::table('product_types')->insert($productTypes);
    }
}
