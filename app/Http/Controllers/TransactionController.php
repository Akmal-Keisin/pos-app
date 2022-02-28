<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\User;
use App\Models\Member;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Discount;
use Illuminate\Support\Facades\Session;

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
        if(session('cart')) {
            $discount = 0;
            if(Discount::where('coupon', '=', $request->coupon)->exists()) {
                $discount = Discount::where('coupon', '=', $request->coupon)->first();
                $discount = $discount->value;
            }
            $total_cost = 0;
            $profit = 0;
            $point = 0;
            foreach (session()->get('cart') as $data) {
                $total_cost += $data['cost'];
                $product = Product::findOrFail($data['product_id']);
                if ($product->stock < $data['qty']) {
                    return back()->with('failed', 'Product stock is not enough');
                }
                $profit += $product->profit * $data['qty'];
                $point += $product->member_point * $data['qty'];
            }
            $discount = $total_cost * $discount/100;
            $total_cost = $total_cost - $discount;
            if(Auth::user()->money < $total_cost) {
                return back()->with('failed', 'Your money is not enough for the transaction');
            }

            if(Member::where('user_id', '=', Auth::user()->id)->exists()) {
                $member = (Member::where('user_id', '=', Auth::user()->id)->first());
                $member->point = $member->point + $point;
                $member->save();
            }

            // creating the transaction data
            $transaction = [
                'user_id' => Auth::user()->id,
                'total_cost' => $total_cost,
                'address' => Auth::user()->address,
                'profit' => $profit,
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

            $orders = Order::where('transaction_id', '=', $transaction_id)->get();
            $transactions = Transaction::where('id', '=', $transaction_id)->first();

            session()->forget('cart');
            $data = [
                'orders' => $orders,
                'transactions' => $transactions,
                'date' => Carbon::today()->toFormattedDateString(),
                'discount' => $discount
            ];
            Session::put('data', $data);
            return view('main.web.print_receipt', [
                'orders' => $orders,
                'transactions' => $transactions,
                'date' => Carbon::today()->toFormattedDateString(),
                'discount' => $discount
            ]);
        } else {
            return back()->with('failed', 'Your cart is empty');
        }
    }

    public function print(Request $request) {
        $pdf = PDF::loadView('main.web.receipt', Session::get('data'));
        return $pdf->download();
    }

    public function show($transaction) {
        $transactions = Order::where('transaction_id', $transaction)->get();
        return view('admin.web.transaction_detail', [
            'transactions' => $transactions
        ]);
    }
}
