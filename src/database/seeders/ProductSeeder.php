<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'Продукт 1', 'description' => 'Описание продукта 1', 'price' => 10000, 'category_id' => 1],
            ['name' => 'Продукт 2', 'description' => 'Описание продукта 2', 'price' => 20000, 'category_id' => 2],
            ['name' => 'Продукт 3', 'description' => 'Описание продукта 3', 'price' => 30000, 'category_id' => 3],
            ['name' => 'Продукт 4', 'description' => 'Описание продукта 4', 'price' => 40000, 'category_id' => 1],
            ['name' => 'Продукт 5', 'description' => 'Описание продукта 5', 'price' => 50000, 'category_id' => 2],
            ['name' => 'Продукт 6', 'description' => 'Описание продукта 6', 'price' => 60000, 'category_id' => 3],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate($product);
        }
    }
}
