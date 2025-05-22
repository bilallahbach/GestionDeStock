<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\supplier;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        supplier::factory(10)->create();
        Category::factory(5)->create();
        Store::factory(3)->create();
        Customer::factory(20)->create();

        Product::factory(50)->create()->each(function($product) {
            Stock::factory()->create(['product_id' => $product->id]);
        });

        Order::factory(30)->create()->each(function($order) {
            $products = Product::inRandomOrder()->take(rand(1, 5))->get();
            foreach ($products as $product) {
                $order->products()->attach($product->id, [
                    'quantity' => rand(1, 5),
                    'price' => $product->price ?? rand(100, 500)
                ]);
            }
        });

        Transaction::factory(50)->create();

    }
}
