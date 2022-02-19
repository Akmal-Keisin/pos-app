<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MainController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('main.web.home', [
            'products' => $products
        ]);
    }

    public function show(Product $product) {
        return view('main.web.product_detail', [
            'product' => $product
        ]);
    }
}
