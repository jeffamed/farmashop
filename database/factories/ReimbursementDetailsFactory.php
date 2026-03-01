<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Reimbursement;
use App\Models\ReimbursementDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReimbursementDetailsFactory extends Factory
{
    protected $model = ReimbursementDetails::class;

    public function definition(): array
    {
        return [
            'quantity' => $this->faker->randomNumber(),
            'price' => $this->faker->randomFloat(),

            'reimbursement_id' => Reimbursement::factory(),
            'product_id' => Product::factory(),
        ];
    }
}
