<?php

namespace Database\Factories;

use App\Enums\StatusesReimbursement;
use App\Models\Order;
use App\Models\Reimbursement;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReimbursementFactory extends Factory
{
    protected $model = Reimbursement::class;

    public function definition(): array
    {
        return [
            'total' => $this->faker->randomFloat(),
            'status' => $this->faker->randomElement(StatusesReimbursement::cases()),
            'observation' => $this->faker->sentence(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'supplier_id' => Supplier::factory(),
            'order_id' => Order::factory(),
        ];
    }
}
