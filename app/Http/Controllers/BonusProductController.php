<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests\BonusRequest;
use Illuminate\Support\Facades\Cache;

class BonusProductController extends Controller
{
    public function __invoke(BonusRequest $request, Product $product)
    {
        $lock = Cache::lock('bonusProcessing', 10);
        try {
            if ($lock->get()) {
                $product->stock += $request->integer('quantity');
                $product->save();
            } else {
                return response()->json(['message' => 'El recurso está siendo usado por otro proceso'], Response::HTTP_LOCKED);
            }

        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al actualizar el stock'], Response::HTTP_INTERNAL_SERVER_ERROR);
        } finally {
            optional($lock)->release();
        }
        return response()->json('Stock actualizado correctamente', Response::HTTP_OK);
    }
}
