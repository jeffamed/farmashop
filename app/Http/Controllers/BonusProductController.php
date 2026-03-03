<?php

namespace App\Http\Controllers;

use App\Http\Requests\BonusRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class BonusProductController extends Controller
{
    public function __invoke(BonusRequest $request, Product $product)
    {
        $product->stock += $request->integer('quantity');
        $product->save();

        return response()->json('Stock actualizado correctamente');
    }
}
