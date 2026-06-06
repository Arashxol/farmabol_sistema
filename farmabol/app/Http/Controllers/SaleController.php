<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\SaleService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    protected $saleService;

    public function __construct(SaleService $saleService) {
        $this->saleService = $saleService;
    }

    public function create() {
        $products = Product::where('stock', '>', 0)->get();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        try {
            $this->saleService->execute($validated, Auth::id());
            return redirect()->route('dashboard')->with('success', 'Venta registrada con éxito.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
