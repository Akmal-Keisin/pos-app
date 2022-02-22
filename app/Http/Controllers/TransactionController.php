<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;

use function PHPUnit\Framework\isEmpty;

class TransactionController extends Controller
{
    public function store(Request $request) {
        if(isEmpty($request->session('cart') == false)) {
            $total_cost = 0;
            $profit = 0;
            foreach (session()->get('cart') as $data) {
                $total_cost += $data['cost'];
                $product = Product::findOrFail($data['product_id']);
                $profit += $product->profit * $data['qty'];
            }


            $transaction = [
                'user_id' => Auth::user()->id,
                'total_cost' => $total_cost,
                'address' => Auth::user()->address,
                'profit' => $profit
            ];
            Transaction::create($transaction);


            $transaction_id = Transaction::where('user_id', Auth::user()->id)->latest()->first()->id;
            $orders = session()->get('cart');
            foreach ($orders as $order) {
                $order_data = new Order();
                $order_data->product_id = $order['product_id'];
                $order_data->transaction_id = $transaction_id;
                $order_data->qty = $order['qty'];
                $order_data->cost = $order['cost'];
                $order_data->save();
            }

            session()->forget('cart');
            return back()->with('success', 'checkout successfully');
        }


    }
}
