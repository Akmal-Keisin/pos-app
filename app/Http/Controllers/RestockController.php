<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Modal;
use Illuminate\Http\Request;

class RestockController extends Controller
{
    public function index() {
        $products = Product::orderBy('stock', 'asc')->get();
        return view('admin.web.restock', [
            'products' => $products
        ]);
    }

    public function store(Request $request, $restock) {
        $request->validate([
            'stock' => 'required|integer'
        ]);
        $product = Product::findOrFail($restock);
        $product->stock = $product->stock + $request->stock;
        $product->save();

        $modal = [
          'product_id' => $product->id,
          'stock' => $request->stock,
          'cost' => $request->stock * ($product->price - $product->profit)
        ];
        Modal::create($modal);
        return redirect('/restock')->with('success', 'Product restock successfully');
    }
}
