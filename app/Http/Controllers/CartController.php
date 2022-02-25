<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Index Cart
    public function index() {
        // Get all session data
        // session()->forget('cart');
        $carts = session()->get('cart');
        // dd($carts);
        // Checking if there is carts in the session
        if($carts) {
            // Setting the cost total
            $cost_total = 0;
            foreach ($carts as $cart) {
                $cost_total += $cart['cost'];
            }
        }
        // Set cost total to 0 when there's no carts in session
        else {
            $cost_total = 0;
        }
        return view('main.web.cart', [
            'carts' => $carts,
            'cost_total' => $cost_total
        ]);
    }

    // Store function cart
    public function store(Request $request, $cart) {
        $request->validate([
            'qty' => 'required|numeric'
        ]);

        // Check is product has been in the cart or not
        $product = Product::findOrFail($cart);
        if($request->qty > $product->stock) {
            return back()->with('failed', 'Stock is not enough');
        }

        if (session('cart')) {
            foreach (session()->get('cart') as $cart_data) {
                if ($cart_data['product_name'] === $product->product_name) {
                    return back()->with('failed', 'Product already in cart');
                }
            }
        }

        // Storing data to variable
        $cost = $request->qty * $product->price;
        $data = collect([
            'row_id' => Str::random(20),
            'product_id' => $product->id,
            'product_name' => $product->product_name,
            'price' => $product->price,
            'qty' => $request->qty,
            'profit' => $product->profit,
            'cost' => $cost
        ]);

        // Store variable data to session cart
        session()->push('cart', $data);
        return redirect('/cart');
    }

    // Edit function cart
    public function update(Request $request, $cart) {
        $request->validate([
            'qty' => 'required|numeric'
        ]);

        // Find cart data with looping the cart session
        $carts = Session::get('cart', []);
        foreach ($carts as $cart_data) {
            // Checking is the cart data same with given id or not
            if ($cart_data['row_id'] == $cart) {
                // Updating cart data
                $cart_data['qty'] = $request->qty;
                $cart_data['cost'] = $cart_data['qty'] * $cart_data['price'];
            }
        }

        // Save the data to session
        session()->put('cart', $carts);
        return redirect('/cart')->with('success', 'Cart updated successfully');

    }

    // Delete function cart
    public function destroy($cart) {
        // Looping the indexed array of session
        $carts = session()->get('cart');
        for($i = 0; $i <= count($carts); $i++) {
            // Checking is the id same with given id or not
            if ($carts[$i]['row_id'] == $cart) {
                // Delete the data
                unset($carts[$i]);
            }
        }

        // Reseting the indexed array in session
        $new_carts = array_values($carts);

        // Storing new data session
        session()->put('cart', $new_carts);
        return redirect('/cart')->with('success', 'Cart deleted successfully');
    }

}
