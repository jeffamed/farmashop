<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ReportController extends Controller
{
    public function index()
    {

    }

    public function products()
    {
        $products = Product::all();

        $pdf = \PDF::loadView('report.all_product', compact('products'));

        return $pdf->download('inventario.pdf');
    }
}
