<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = Supplier::all();
        $users = User::all();
        $products = Product::all();

        if ($suppliers->isEmpty() || $users->isEmpty() || $products->isEmpty()) {
            return;
        }

        // Create 15 orders
        for ($i = 1; $i <= 15; $i++) {
            $subtotal = 0;
            $discount = rand(0, 10);
            $iva = 18; // 18% IVA

            $order = Order::create([
                'number_order' => 'ORD-' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'supplier_id' => $suppliers->random()->id,
                'user_id' => $users->random()->id,
                'iva' => $iva,
                'discount' => $discount,
                'subtotal' => 0, // Will be calculated
                'total' => 0, // Will be calculated
            ]);

            // Create 3-7 order details for each order
            $detailsCount = rand(3, 7);
            for ($j = 0; $j < $detailsCount; $j++) {
                $product = $products->random();
                $quantity = rand(10, 100);
                $unitPrice = rand(50, 3000) / 10; // Price between 5.00 and 300.00
                $suggestPrice = $unitPrice * 1.3; // 30% margin
                $detailDiscount = rand(0, 5);

                $detailTotal = ($quantity * $unitPrice) * (1 - $detailDiscount / 100);

                OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'suggest_price' => $suggestPrice,
                    'expire_at' => now()->addMonths(rand(12, 36)),
                    'total' => $detailTotal,
                    'discount' => $detailDiscount,
                ]);

                $subtotal += $detailTotal;
            }

            // Update order totals
            $orderDiscount = $subtotal * ($discount / 100);
            $subtotalAfterDiscount = $subtotal - $orderDiscount;
            $total = $subtotalAfterDiscount * (1 + $iva / 100);

            $order->update([
                'subtotal' => $subtotal,
                'total' => $total,
            ]);
        }
    }
}
