<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Exception;

class SaleService
{
    public function execute(array $data, int $userId): Sale
    {
        return DB::transaction(function () use ($data, $userId) {
            $product = Product::findOrFail($data['product_id']);

            if ($product->stock < $data['cantidad']) {
                throw new Exception('Stock insuficiente para realizar la venta.');
            }

            $total = $product->precio * $data['cantidad'];

            $sale = Sale::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'cantidad' => $data['cantidad'],
                'total' => $total,
            ]);

            // Descuento automático de stock
            $product->decrement('stock', $data['cantidad']);

            return $sale;
        });
    }
}