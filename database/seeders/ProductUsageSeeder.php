<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Usage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductUsageSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $usages = Usage::all();

        if ($products->isEmpty() || $usages->isEmpty()) {
            return;
        }

        // Assign 1-3 usages to each product
        foreach ($products as $product) {
            $usageCount = rand(1, 3);
            $randomUsages = $usages->random(min($usageCount, $usages->count()));

            foreach ($randomUsages as $usage) {
                DB::table('product_usage')->insert([
                    'product_id' => $product->id,
                    'usage_id' => $usage->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
