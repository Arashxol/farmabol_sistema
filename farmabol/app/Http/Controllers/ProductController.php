<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'codigo' => 'required|unique:products',
            'nombre' => 'required',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'laboratorio' => 'required',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }

    // Agrega aquí los métodos show, edit, update y destroy para completar el CRUD básico.
}