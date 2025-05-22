<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transactionable_type' => $this->faker->randomElement([supplier::class, Customer::class]),
            'transactionable_id' => fn($attributes) => $attributes['transactionable_type']::inRandomOrder()->first()->id,
            'operation' => $this->faker->randomElement(['purchase', 'sale']),
        ];
    }
}
