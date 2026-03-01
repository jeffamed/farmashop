<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderDetailsFactory extends Factory
{
    protected $model = OrderDetails::class;

    public function definition(): array
    {
        return [
            'quantity' => $this->faker->randomNumber(),
            'unit_price' => $this->faker->randomFloat(),
            'suggest_price' => $this->faker->randomFloat(),
            'expire_at' => Carbon::now(),
            'total' => $this->faker->randomFloat(),
            'discount' => $this->faker->randomFloat(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
        ];
    }
}
