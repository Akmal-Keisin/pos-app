<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Discount;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TransactionApiController extends Controller
{
    public function store(Request $request) {
        $validatedData = Validator::make($request->all(), [
            'user_id' => 'required|integer'
        ]);
        if($validatedData->fails()) {
            $data = [
                'info' => 'Transaction failed',
                'status' => Response::HTTP_BAD_REQUEST,
                'data' => $validatedData->errors()
            ];
            return response()->json($data, Response::HTTP_BAD_REQUEST);
        }
        $carts = Cart::where('user_id', '=', $request->user_id)->get();
        if(!empty($carts)) {
            $discount = 0;
            if(Discount::where('coupon', '=', $request->coupon)->exists()) {
                $discount = Discount::where('coupon', '=', $request->coupon)->first();
                $discount = $discount->value;
            }
            $total_cost = 0;
            $profit = 0;
            $point = 0;
            foreach ($carts as $data) {
                $total_cost += $data['cost'];
                $product = Product::findOrFail($data['product_id']);
                if ($product->stock < $data['qty']) {
                    $data = [
                        'info' => 'Transaction failed',
                        'status' => Response::HTTP_BAD_REQUEST,
                        'data' => $product->name . ' stock is not enough'
                    ];
                    return response()->json($data, Response::HTTP_BAD_REQUEST);
                }
                $profit += $product->profit * $data['qty'];
                $point += $product->member_point * $data['qty'];
            }
            $discount = $total_cost * $discount/100;
            $total_cost = $total_cost - $discount;
            $user = User::findOrFail($request->user_id);
            if($user->money < $total_cost) {
                $data = [
                    'info' => 'Transaction failed',
                    'status' => Response::HTTP_BAD_REQUEST,
                    'data' => 'User money is not enough'
                ];
                return response()->json($data, Response::HTTP_BAD_REQUEST);
            }

            if(Member::where('user_id', '=', $user->id)->exists()) {
                $member = (Member::where('user_id', '=', $user->id)->first());
                $member->point = $member->point + $point;
                $member->save();
            }

            // creating the transaction data
            $transaction = [
                'user_id' => $user->id,
                'total_cost' => $total_cost,
                'address' => $user->address,
                'profit' => $profit,
            ];
            Transaction::create($transaction);


            $transaction_id = Transaction::where('user_id', $user->id)->latest()->first()->id;
            $orders = $carts;
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
            $user = User::findOrFail($user->id);
            $user->money = $user->money - $total_cost;
            $user->save();

            $orders = Order::where('transaction_id', '=', $transaction_id)->get();
            $transactions = Transaction::where('id', '=', $transaction_id)->first();
            $data = [
                'info' => 'Transaction success',
                'status' => Response::HTTP_OK,
                'data' => [
                    'transaction' => $transaction,
                    'discount' => $discount,
                    'date' => Carbon::today()->toFormattedDateString(),
                    'transaction_detail' => $orders
                ],
            ];

            foreach ($carts as $cart) {
                $cart->delete();
            }
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data = [
                'info' => 'Transaction failed',
                'status' => Response::HTTP_BAD_REQUEST,
                'data' => 'User cart is empty'
            ];
            return response()->json($data, Response::HTTP_BAD_REQUEST);
        }
    }
}
