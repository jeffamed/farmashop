<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition(): array
    {
        return [
            'iva' => $this->faker->randomFloat(),
            'subtotal' => $this->faker->randomFloat(),
            'total' => $this->faker->randomFloat(),
            'discount' => $this->faker->randomFloat(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'customer_id' => Customer::factory(),
            'user_id' => User::factory(),
        ];
    }
}
