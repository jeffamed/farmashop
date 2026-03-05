<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
use Illuminate\Support\Facades\DB;

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

    public function sales()
    {
        DB::statement("SET lc_time_names = 'es_ES'");
        $sales = DB::table('sales')
            ->selectRaw('MONTHNAME(sales.created_at) as mes, sum(subtotal) as subTotal, sum(discount) as Descuento, sum(total) as Total')
            ->whereYear('created_at',now())
            ->groupByRaw('mes')
            ->orderByRaw('mes desc')
            ->get();
        $sales_total = DB::table('sales')
            ->selectRaw('sum(subtotal) as subTotal, sum(discount) as Descuento, sum(total) as Total')
            ->whereYear('created_at',now())
            ->get();
        $pdf = \PDF::loadView('report.sales', compact('sales','sales_total'))->setPaper('letter', 'portrait');
        return $pdf->download('ventas_segun_meses.pdf');
    }

    public function invoice(Sale $sale, $type)
    {
        $customer = Customer::find($sale->customer_id);

        $details = SaleDetails::with('product')->where('sale_id', $sale->id)->get();

        $pdf = \PDF::loadView('report.invoice', compact('sale','customer','details'))->setPaper('letter', 'landscape');
        return $type === 'download' ? $pdf->download('factura.pdf') : $pdf->stream();

    }
}
