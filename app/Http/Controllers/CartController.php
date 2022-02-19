<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $cart = session()->get('cart');
        return view('main.web.cart', [
            'carts' => $cart
        ]);
    }

    public function store(Request $request, $cart) {
        $validatedData = $request->validate([
            'qty' => 'required|numeric'
        ]);
        $product = Product::findOrFail($cart);
        $cost = $request->qty * $product->price;
        $data = collect([
            'product_name' => $product->product_name,
            'price' => $product->price,
            'qty' => $request->qty,
            'cost' => $cost
        ]);
        session()->push('cart', $data);
        return redirect('/cart');
    }
}
