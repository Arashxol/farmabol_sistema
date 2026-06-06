<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke() {
        // Productos con stock bajo (< 5 unidades)
        $lowStockProducts = Product::where('stock', '<', 5)->get();

        // Total de ventas del día actual
        $todaySalesTotal = Sale::whereDate('created_at', Carbon::today())->sum('total');

        return view('dashboard', compact('lowStockProducts', 'todaySalesTotal'));
    }
}
