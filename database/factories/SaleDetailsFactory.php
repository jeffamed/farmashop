<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SaleDetailsFactory extends Factory
{
    protected $model = SaleDetails::class;

    public function definition(): array
    {
        return [
            'quantity' => $this->faker->randomNumber(),
            'price' => $this->faker->randomFloat(),
            'total' => $this->faker->randomFloat(),
            'discount' => $this->faker->randomFloat(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'sale_id' => Sale::factory(),
            'product_id' => Product::factory(),
        ];
    }
}
