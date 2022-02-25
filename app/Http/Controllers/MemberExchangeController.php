<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MemberExchange;
use App\Models\MemberProduct;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberExchangeController extends Controller
{
    public function index() {
        $exchanges = MemberExchange::all();
        return view('admin.web.member_exchange_list', [
            'exchanges' => $exchanges
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'qty' => 'required|integer'
        ]);
        if ($request->qty < 0) {
            return back()->with('failed', 'Quantity must be positive number');
        }

        $product = MemberProduct::findOrFail($request->product_id);
        $member = Member::where('user_id', '=', Auth::user()->id)->first();
        $point_total = $product->point * $request->qty;

        if($member->point < $point_total) {
            return back()->with('failed', 'Your point is not enough');
        }

        $member->point = $member->point - $product->point * $request->qty;
        $member->save();

        $exchange = [
            'member_product_id' => $product->id,
            'user_id' => Auth::user()->id,
            'qty' => $request->qty,
            'point_total' => $point_total
        ];
        MemberExchange::create($exchange);

        return redirect('/member')->with('success', 'Exchange success');
    }
}
