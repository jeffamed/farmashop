<?php

namespace Database\Factories;

use App\Models\Laboratory;
use App\Models\location;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->word(),
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(),
            'stock' => $this->faker->randomNumber(),
            'discount' => $this->faker->randomFloat(),
            'box_stock' => $this->faker->randomFloat(),
            'unit_box' => $this->faker->randomNumber(100),
            'expired_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'laboratory_id' => Laboratory::factory(),
            'type_id' => Type::factory(),
            'location_id' => location::factory(),
            'supplier_id' => Supplier::factory(),
        ];
    }
}
