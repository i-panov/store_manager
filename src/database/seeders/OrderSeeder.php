<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            ['product_id' => 1, 'product_count' => 2, 'product_price' => 10000, 'status' => 'new', 'customer_name' => 'Customer 1', 'comment' => 'Comment 1'],
            ['product_id' => 2, 'product_count' => 3, 'product_price' => 20000, 'status' => 'completed', 'customer_name' => 'Customer 2', 'comment' => 'Comment 2'],
            ['product_id' => 3, 'product_count' => 1, 'product_price' => 30000, 'status' => 'new', 'customer_name' => 'Customer 3', 'comment' => 'Comment 3'],
            ['product_id' => 4, 'product_count' => 2, 'product_price' => 40000, 'status' => 'completed', 'customer_name' => 'Customer 4', 'comment' => 'Comment 4'],
        ];

        foreach ($orders as $order) {
            Order::firstOrCreate($order);
        }
    }
}
