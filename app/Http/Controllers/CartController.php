<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index() {
        // session()->forget('cart');
        $carts = session()->get('cart');
        if($carts) {
            $cost_total = 0;
            foreach ($carts as $cart) {
                $cost_total += $cart['cost'];
            }
        }
        else {
            $cost_total = 0;
        }
        return view('main.web.cart', [
            'carts' => $carts,
            'cost_total' => $cost_total
        ]);
    }

    public function store(Request $request, $cart) {
        $request->validate([
            'qty' => 'required|numeric'
        ]);

        $product = Product::findOrFail($cart);
        if (session('cart')) {
            foreach (session()->get('cart') as $cart_data) {
                if ($cart_data['product_name'] === $product->product_name) {
                    return back()->with('failed', 'Product already in cart');
                }
            }
        }

        $cost = $request->qty * $product->price;
        $data = collect([
            'row_id' => Str::random(20),
            'product_name' => $product->product_name,
            'price' => $product->price,
            'qty' => $request->qty,
            'cost' => $cost
        ]);

        session()->push('cart', $data);
        return redirect('/cart');
    }

    public function update(Request $request, $cart) {
        $request->validate([
            'qty' => 'required|numeric'
        ]);

        $carts = Session::get('cart', []);
        foreach ($carts as $cart_data) {
            if ($cart_data['row_id'] == $cart) {
                $cart_data['qty'] = $request->qty;
                $cart_data['cost'] = $cart_data['qty'] * $cart_data['price'];
            }
        }

        session()->put('cart', $carts);
        return redirect('/cart')->with('success', 'Cart updated successfully');

    }

    public function destroy($cart) {

    }

}
