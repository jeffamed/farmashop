<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;

class SaleObserver
{
    public function deleted(Sale $sale): void
    {
        $details = SaleDetails::where('sale_id', $sale->id)->get();
        if($details){
            foreach ($details as $detail){
                $product = Product::find($detail->product_id);
                $product->stock = $product->stock + $detail->quantity;
                $product->save();
            }
        }
    }
}
