<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\User;
use App\Notifications\LowStockNotification;
use Illuminate\Support\Facades\Redis;

class ProductObserver
{
    public function saving(Product $product): void
    {
        $product->box_stock = $product->stock / $product->unit_box;
    }
    public function saved(Product $product): void
    {
        if ($product->wasChanged('stock')) {
            $lowStockKey = 'alert:low_stock';
            if ($product->stock <= 10) {
               $this->LowStock($product, $lowStockKey);
            } else {
                Redis::sRem($lowStockKey, $product->id);
            }
        }
    }

    private function LowStock($product, $lowStockKey): void
    {
        if (!Redis::sismember($lowStockKey, $product->id)) {
            Redis::sAdd($lowStockKey, $product->id);
        }
        $admin = User::where('role', 'admin')->get();
        $admin->each(function (User $user) use ($product){
            $user->notify(new LowStockNotification($product));
        });
    }

    private function withoutStock()
    {

    }
}
