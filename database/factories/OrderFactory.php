<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'number_order' => $this->faker->iban,
            'iva' => $this->faker->randomFloat(),
            'subtotal' => $this->faker->randomFloat(),
            'total' => $this->faker->randomFloat(),
            'discount' => $this->faker->randomFloat(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'supplier_id' => Supplier::factory(),
            'user_id' => User::factory(),
        ];
    }
}
