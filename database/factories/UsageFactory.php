<?php

namespace Database\Factories;

use App\Models\Usage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UsageFactory extends Factory
{
    protected $model = Usage::class;

    public function definition(): array
    {
        return [
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
