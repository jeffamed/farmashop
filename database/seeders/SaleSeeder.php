<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();
        $users = User::all();
        $products = Product::all();

        if ($customers->isEmpty() || $users->isEmpty() || $products->isEmpty()) {
            return;
        }

        // Create 30 sales
        for ($i = 1; $i <= 30; $i++) {
            $subtotal = 0;
            $discount = rand(0, 15);
            $iva = 18; // 18% IVA

            $sale = Sale::create([
                'customer_id' => $customers->random()->id,
                'user_id' => $users->random()->id,
                'iva' => $iva,
                'discount' => $discount,
                'subtotal' => 0, // Will be calculated
                'total' => 0, // Will be calculated
            ]);

            // Create 1-5 sale details for each sale
            $detailsCount = rand(1, 5);
            for ($j = 0; $j < $detailsCount; $j++) {
                $product = $products->random();
                $quantity = rand(1, 10);
                $price = rand(100, 5000) / 10; // Price between 10.00 and 500.00
                $detailDiscount = rand(0, 10);

                $detailTotal = ($quantity * $price) * (1 - $detailDiscount / 100);

                SaleDetails::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total' => $detailTotal,
                    'discount' => $detailDiscount,
                ]);

                $subtotal += $detailTotal;
            }

            // Update sale totals
            $saleDiscount = $subtotal * ($discount / 100);
            $subtotalAfterDiscount = $subtotal - $saleDiscount;
            $total = $subtotalAfterDiscount * (1 + $iva / 100);

            $sale->update([
                'subtotal' => $subtotal,
                'total' => $total,
            ]);
        }
    }
}
