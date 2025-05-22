<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\supplier;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'supplier_id' => supplier::factory(),
            'name' => fake()->name(),
            'description' => Str::random(10),
            'price' => fake()->numberBetween(10,100),
        ];
    }
}
