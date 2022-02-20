<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MainController extends Controller
{
    public function index() {
        $products = Product::all();
        if (request('search')) {
            $products = Product::where('product_name', 'like' , '%' .  request('search') . '%')->get();
        }
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
