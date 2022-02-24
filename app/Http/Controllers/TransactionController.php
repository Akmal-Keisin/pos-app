<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;

use function PHPUnit\Framework\isEmpty;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::all();
        return view('admin.web.transaction_list', [
            'transactions' => $transactions
        ]);
    }

    public function store(Request $request) {
        if(isEmpty($request->session('cart') == false)) {
            $total_cost = 0;
            $profit = 0;
            foreach (session()->get('cart') as $data) {
                $total_cost += $data['cost'];
                $product = Product::findOrFail($data['product_id']);
                $profit += $product->profit * $data['qty'];
            }

            if(Auth::user()->money < $total_cost) {
                return back()->with('failed', 'Your money is not enough for the transaction');
            }

            // creating the transaction data
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
                // save order data for transaction detail
                $order_data = new Order();
                $order_data->product_id = $order['product_id'];
                $order_data->transaction_id = $transaction_id;
                $order_data->qty = $order['qty'];
                $order_data->cost = $order['cost'];
                $order_data->save();

                // reduce the product stock after transaction
                $product = Product::findOrFail($order['product_id']);
                $product->stock = $product->stock - $order['qty'];
                $product->save();
            }

            // reduce money after transaction
            $user = User::findOrFail(Auth::user()->id);
            $user->money = $user->money - $total_cost;
            $user->save();


            session()->forget('cart');
            return back()->with('success', 'checkout successfully');
        }


    }
}
